<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use App\Entities\User;
use App\Entities\StudentInformations;
use App\Entities\StudentParent;
use App\Entities\TeacherInformation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Helpers\Statics\UserRolesStatic;
use App\Helpers\Statics\UserStatusStatic;
use App\Helpers\Statics\ConnectParentStatusStatic;
use App\Helpers\Traits\UploadImageTrait;

class StudentService {
    use UploadImageTrait;

    public function index($request)
    {
        $limit = $request->get('limit', 10);
        $keyword = $request->get('keyword', null);
        $status = $request->get('status', null);
        $studentsQuery = User::select(['id', 'name', 'email', 'description'])
            ->where('role', UserRolesStatic::STUDENT);
        
        if ($keyword) {
            $studentsQuery->where(function($query) use ($keyword){
                $query->where('email', 'like', '%'.$keyword.'%');
                $query->orWhere('name', 'like' , '%'.$keyword.'%');
            });
        }
        
        if (!is_null($status)) {
            $studentsQuery->where('status', $status);
        }

        $students = $studentsQuery->paginate($limit)
            ->appends(
                request()->query()
            );

        return response()
            ->json($students);         
    }

    public function register($request)
    {
        $data = $request->all();
        $avatar = $request->file('avatar');
        $filePath = $this->uploadAvatar($avatar);

        $userData = [
            'name' => $data['name'], 
            'email' => $data['email'], 
            'password' => Hash::make($data['password']), 
            'date_of_birth' => $data['date_of_birth'],
            'role' => UserRolesStatic::STUDENT,
            'description' => $data['description'],
            'avatar' => $filePath,
            'status' => UserStatusStatic::ACTIVE
        ];
        
        $user = User::create($userData);

        $studentData = [
            'phone_number' => $data['phone_number'],
            'school' => $data['school'],
            'class' => $data['class'],
        ];
        $user->studentInformation()->create($studentData);


        $user->load('studentInformation');

        return response()
            ->json($user); 
    }

    public function info()
    {
        $user = \Auth::user();
        $user->load('studentInformation');

        return response()
            ->json($user);
    }

    public function detail($id)
    {
        $user = User::find($id);
        $user->load('studentInformation');
       
        return response()
            ->json($user);
    }

    public function approve($request)
    {
        $data = [
            'connect_status' => ConnectParentStatusStatic::APPROVED,
        ];
        $updateConnectStatus = StudentParent::find($request->id)->update($data);

        return response()
            ->json($updateConnectStatus);
    }

    public function reject($request)
    {
        $data = [
            'connect_status' => ConnectParentStatusStatic::REJECTED
        ];
        $updateConnectStatus = StudentParent::find($request->id)->update($data);

        return response()
            ->json($updateConnectStatus);
    }

    public function parentList()
    {
        $user = \Auth::user();
        $parents = DB::table('users')
            ->join('student_parent', 'users.id', '=', 'student_parent.user_id')
            ->join('parent_informations', 'users.id', '=', 'parent_informations.user_id')
            ->where('student_parent.student_id',$user->id)
            ->select('users.id','users.name','parent_informations.phone_number','student_parent.connect_status')
            ->get();
            
        return response()
            ->json($parents);
    }

    public function searchTeacher($request)
    {
        $limit = $request->get('limit', 10);
        $keyword = $request->get('keyword', null);
        $status = $request->get('status', null);

        $teachersQuery = DB::table('teacher_informations')
            ->join('users', 'teacher_informations.user_id', '=', 'users.id')
            ->join('teacher_grade_subject', 'teacher_informations.id', '=', 'teacher_grade_subject.teacher_id')
            ->join('grades', 'teacher_grade_subject.grade_id', '=', 'grades.id')
            ->join('subjects', 'teacher_grade_subject.subject_id', '=', 'subjects.id')
            ->select('teacher_informations.id','users.name','users.email','grades.name as grade','subjects.name as subject');

        if ($keyword) {
            $teachersQuery->where(function($query) use ($keyword){
                $query->where('users.email', 'like', '%'.$keyword.'%');
                $query->orWhere('users.name', 'like' , '%'.$keyword.'%');
                $query->orWhere('grades.name', 'like' , '%'.$keyword.'%');
                $query->orWhere('subjects.name', 'like' , '%'.$keyword.'%');
            });
        }

        if (!is_null($status)) {
            $teachersQuery->where('users.status', $status);
        }

        $teachers = $teachersQuery->paginate($limit)
            ->appends(
                request()->query()
            );

        return response()
            ->json($teachers);     
    }

    public function detailTeacher($id)
    {
        $teachersQuery = DB::table('teacher_informations')
            ->join('users', 'teacher_informations.user_id', '=', 'users.id')
            ->join('teacher_grade_subject', 'teacher_informations.id', '=', 'teacher_grade_subject.teacher_id')
            ->join('grades', 'teacher_grade_subject.grade_id', '=', 'grades.id')
            ->join('subjects', 'teacher_grade_subject.subject_id', '=', 'subjects.id')
            ->where('teacher_informations.id',$id)
            ->select('teacher_informations.id','users.name','users.email','grades.name','subjects.name')
            ->get();

        return response()
            ->json($teachersQuery);
    }

    public function subscribeTeacher($id)
    {
        $user = \Auth::user();
        $user->teacherStudents()->attach($id,[
            'is_favorite_teacher' => 1,
            'is_favorite_student' => 0,
        ]);
        $user->load(['studentInformation','teacherStudents']);
        return response()
            ->json($user);
    }

}

?>