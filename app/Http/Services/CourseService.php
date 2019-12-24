<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\Course;
use App\Entities\Grade;
use App\Entities\Subject;
use App\Helpers\Statics\CourseStatusStatic;
use App\Helpers\Traits\UploadImageTrait;
use DateTime;
use Illuminate\Support\Facades\Date;

class CourseService {
    use UploadImageTrait;

    public function create($request)
    {
        $avatar = $request->file('avatar');
        $filePath = $this->uploadAvatar($avatar);

        $data = $request->all();
        $data['teacher_id'] = Auth::id();
        $data['avatar'] = $filePath; 
        $course = Course::create($data);

        $lessons = $data['lessons'];
        foreach($lessons as $lesson){
            $course->lessons()->attach($lesson['id'], [
                'start_at' =>  $lesson['start_at'],
                'end_at' => $lesson['end_at']
            ]);
        }

        return response()
            ->json($course); 
    }

    public function detail($id)
    {
        $course = Course::with([
            'grade:id,name', 
            'subject:id,name',
            'teacher:id,name,avatar',
            'lessons:lesson_id,name,start_at,end_at,description',
            'comments.user:id,name,avatar',
            'enrolledStudent' => function ($q) {
                $q->select('users.name','users.id');
                $q->where('users.id', auth()->id());
            }
        ])->find($id);

        return response()
            ->json($course); 
    }

    public function recommend($request)
    {
        $limit = $request->get('limit', 3);
        $user = auth()->user();
        $ages = date_diff(new DateTime(), new DateTime($user->date_of_birth))->y;
        $gradesId = Grade::select('id')
            ->where('recommend_from_age', '<=', $ages)
            ->where('recommend_to_age', '>=', $ages)
            ->get()
            ->pluck('id');

        $courses = Course::with(['grade:id,name', 'subject:id,name'])
            ->whereIn('grade_id', $gradesId)
            ->where('start_at', '>=', new DateTime())
            ->where('end_at', '>=', new DateTime())
            ->paginate($limit);
        
        return response()
            ->json($courses); 
    }

    public function studentMyCourses($request)
    {
        $limit = $request->get('limit', 3);
        $user = auth()->user();
        $courses = $user->enrolledCourse()
            ->with(['grade:id,name', 'subject:id,name'])
            ->orderBy('id', 'desc')
            ->paginate($limit);
        
        return response()
            ->json($courses);
    }

    public function studentIndex($request)
    {
        $user = auth()->user();
        $ages = date_diff(new DateTime(), new DateTime($user->date_of_birth))->y;
        
        $filterGrade = $request->get('grade');
        $filterSubject = $request->get('subject');

        $gradesIds = [];
        if($filterGrade) {
            $gradesIds[] = $filterSubject;
        }
        else{
            $gradesIds = Grade::select('id')
            ->where('recommend_from_age', '<=', $ages)
            ->where('recommend_to_age', '>=', $ages)
            ->get()
            ->pluck('id');
        }

        $coursesBySubject = Subject::with([
            'courses' => function ($q) use ($gradesIds) {
                $q->with(['grade:id,name', 'subject:id,name']);
                $q->whereIn('grade_id', $gradesIds);
                $q->limit(9);
            } 
        ]);

        if($filterSubject) {
            $coursesBySubject->where('id', $filterSubject);
        }


        return response()->json(
            $coursesBySubject->get()
        );
    }

    public function enroll($id)
    {
        $course = Course::find($id);
        $user = auth()->user();
        if (!$course) {
            return response()
                ->json('Không tìm thấy khóa học', 422); 
        }


        if (new DateTime($course->end_at) < new DateTime()) {
            return response()
                ->json('Khóa học đã kết thúc', 422);
        }


        if ($user->cp < $course->tuition_fee) {
            return response()
                ->json('Không đủ CP để tham gia khóa học', 422);
        }

        $user->enrolledCourse()->sync($course->id, false);
        $user->decrement('cp', $course->tuition_fee);

        return response()
            ->json('Thành công', 200);
    }

    public function addComment($request)
    {
        $comment = Course::find($request->course_id)
            ->comments()
            ->create([
                'user_id' => auth()->id(),
                'content' => $request->get('content')
            ]);
        
        return response()
            ->json($comment, 200);
    }
}

?>