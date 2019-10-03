<?php

namespace App\Helpers\Statics;

class CourseStatusStatic {
    const PUBLISHED = 1;
    const UNPUBLISHED = 0;

    public static function getCourseStatusChoices()
    {
        return [
            self::PUBLISHED => trans('messages.status_published'),
            self::UNPUBLISHED => trans('messages.status_unpublished'),
            self::WAITING_APPROVE => trans('messages.status_waiting_approve'),
        ];
    }

    public static function getCourseStatusText($status)
    {
        $statusList = self::getCourseStatusChoices();
        return isset($statusList[$status]) ? $statusList[$status] : '-empty-';
    }
}


?>