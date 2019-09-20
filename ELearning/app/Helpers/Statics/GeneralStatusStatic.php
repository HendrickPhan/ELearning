<?php

namespace App\Helpers\Statics;

class GeneralStatusStatic {
    const PUBLISHED = 0;
    const UNPUBLISHED = 1;
    const FEATURED = 2;

    public static function getStatusChoices()
    {
        return [
            self::PUBLISHED => trans('messages.status_published'),
            self::UNPUBLISHED => trans('messages.status_unpublished'),
            self::FEATURED => trans('messages.status_featured'),
        ];
    }

    public static function getStatusText($status)
    {
        $statusList = self::getStatusChoices();
        return isset($statusList[$status]) ? $statusList[$status] : '-empty-';
    }
}


?>