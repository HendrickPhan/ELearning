<?php

namespace App\Helpers\Statics;

class UserStatusStatic {
    const ACTIVE = 1;
    const INACTIVE = 0;

    public static function getUserStatusChoices()
    {
        return [
            self::ACTIVE => trans('messages.status_active'),
            self::INACTIVE => trans('messages.status_inactive'),
        ];
    }

    public static function getUserStatusText($status)
    {
        $statusList = self::getUserStatusChoices();
        return isset($statusList[$status]) ? $statusList[$status] : '-empty-';
    }
}


?>