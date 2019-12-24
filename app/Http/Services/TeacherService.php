<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Entities\TeacherStudent;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Statics\UserRolesStatic;
use App\Helpers\Statics\UserStatusStatic;
use App\Helpers\Traits\UploadImageTrait;

class TeacherService {
    use UploadImageTrait;

    public function index($request)
    {
        $limit = $request->get('limit', 10);
        $keyword = $request->get('keyword', null);
        $status = $request->get('status', UserStatusStatic::ACTIVE);
        $teachersQuery = User::select(['id', 'name', 'email', 'description', 'avatar'])
            ->where('role', UserRolesStatic::TEACHER);
        
        if ($keyword) {
            $teachersQuery->where(function($query) use ($keyword){
                $query->where('email', 'like', '%'.$keyword.'%');
                $query->orWhere('name', 'like' , '%'.$keyword.'%');
            });
        }
        
        if (!is_null($status)) {
            $teachersQuery->where('status', $status);
        }

        $teachers = $teachersQuery->paginate($limit)
            ->appends(
                request()->query()
            );

        return response()
            ->json($teachers);         
    }

    public function register($request)
    {
        $data = $request->all();
        $avatar = $request->file('avatar');
        $filePath = $this->uploadAvatar($avatar);

        //basic user info
        $userData = [
            'name' => $data['name'], 
            'email' => $data['email'], 
            'password' => Hash::make($data['password']), 
            'date_of_birth' => $data['date_of_birth'],
            'role' => UserRolesStatic::TEACHER,
            'description' => $data['description'],
            'avatar' => $filePath,
            'gender' => $data['gender'],
            'status' => UserStatusStatic::INACTIVE
        ];
        $user = User::create($userData);

        //teacher info
        $teacherData = [
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'experience' => isset($data['experience']) ? $data['experience'] : null,
        ];
        $user->teacherInformation()->create($teacherData);

        $user->load(['teacherInformation','teacherCertificates']);

        $token = auth()->attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        return response()->json([
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function attachCertificates($request)
    {
        $user = auth()->user();
        $data = $request->all();

        //certificate info
        $certificates = isset($data['certificates']) ? $data['certificates'] : [];
        foreach($certificates as $certificate){
            $image = $request->file('certificate-' . $certificate['id']);
            $filePath = $image ? $this->uploadCertificate($image) : null;

            $user->teacherCertificates()->attach($certificate['id'], [
                'image' =>  $filePath,
                'date_of_issue' => $certificate['date_of_issue']
            ]);
        }
        
        $user->load('teacherCertificates');

        return response()
            ->json($user);
    }

    public function attachGradeSubjects($request)
    {
        $user = auth()->user();
        $data = $request->all();

        $gradeSubjects = isset($data['grade_subjects']) ? $data['grade_subjects'] : [];
        foreach ($gradeSubjects as $gradeSubject) {
            foreach($gradeSubject['grade_ids'] as $gradeId) {
                $user->teacherGradeSubject()->create(
                    [
                        'subject_id' => $gradeSubject['subject_id'],
                        'grade_id' => $gradeId,
                    ]);
            }
        }

        $user->load('teacherGradeSubject');
        return response()
        ->json($user);
    }

    public function info()
    {
        $user = \Auth::user();
        $user->load([
            'teacherInformation',
            'teacherCertificates',
            'teacherGradeSubject',
        ]);

        return response()
            ->json($user);
    }

    public function detail($id)
    {
        $teacher = User::with([
            'teacherInformation'.
            'teacherCertificates'
            ])
            ->select(
                'id', 
                'name',
                'email', 
                'avatar',
                'date_of_birth',
                'description'
            )
            ->where('id', $id)
            ->where('role', UserRolesStatic::TEACHER)
            ->where('status', UserStatusStatic::ACTIVE)
            ->first();

        return response()
            ->json($teacher);
    }

    public function subscribeTeacher($id)
    {
        $user = Auth::user();
        $teachersSubscribed = $user->teachersSubscribed()->create(
            [
                'teacher_id' => $id
            ]
        );
        return response()
            ->json($teachersSubscribed);
    }
}

?>