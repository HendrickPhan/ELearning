<?php

namespace App\Helpers\Statics;

class ParentStudentStatusStatic {
    const PENDING = 0;
    const APPROVED = 1;
    const REJECTED = 2;

    public static function getStatusChoices()
    {
        return [
            self::PENDING => trans('messages.status_pending'),
            self::APPROVED => trans('messages.status_approved'),
            self::REJECTED => trans('messages.status_rejected'),
        ];
    }

    public static function getStatusText($status)
    {
        $statusList = self::getConnectChoices();
        return isset($statusList[$status]) ? $statusList[$status] : '-empty-';
    }

    
}
?>