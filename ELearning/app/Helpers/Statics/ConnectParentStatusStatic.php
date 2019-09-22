<?php

namespace App\Helpers\Statics;

class ConnectParentStatusStatic {
    const PENDING = 0;
    const APPROVED = 1;
    const REJECTED = 2;

    public static function getConnectStatusChoices()
    {
        return [
            self::PENDING => trans('messages.status_pending'),
            self::APPROVED => trans('messages.status_approved'),
            self::REJECTED => trans('messages.status_rejected'),
        ];
    }

    public static function getConnectStatusText($status)
    {
        $statusList = self::getConnectChoices();
        return isset($statusList[$status]) ? $statusList[$status] : '-empty-';
    }

    
}


?>