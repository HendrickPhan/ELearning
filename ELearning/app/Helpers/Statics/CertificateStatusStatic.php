<?php

namespace App\Helpers\Statics;

class CertificateStatusStatic {
    const NOT_FEATURED = 0;
    const FEATURED = 1;

    public static function getCetificateStatusChoices()
    {
        return [
            self::NOT_FEATURED => trans('messages.status_not_featured'),
            self::FEATURED => trans('messages.status_featured'),
        ];
    }

    public static function getCetificateStatusText($status)
    {
        $statusList = self::getCetificateStatusChoices();
        return isset($statusList[$status]) ? $statusList[$status] : '-empty-';
    }
}


?>