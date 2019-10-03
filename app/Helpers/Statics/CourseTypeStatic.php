<?php

namespace App\Helpers\Statics;

class CourseTypeStatic {
    const PRIVATE = 0;
    const PUBLIC = 1;
    const NEED_APPROVE = 2;

    public static function getCourseTypeChoices()
    {
        return [
            self::PUBLIC => trans('messages.status_active'),
            self::PRIVATE => trans('messages.status_inactive'),
            self::NEED_APPROVE => trans('messages.status_inactive'),
        ];
    }

    public static function getCourseTypeText($type)
    {
        $typeList = self::getCourseTypeChoices();
        return isset($typeList[$type]) ? $typeList[$type] : '-empty-';
    }
}


?>