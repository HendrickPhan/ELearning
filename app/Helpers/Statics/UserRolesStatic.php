<?php

namespace App\Helpers\Statics;

class UserRolesStatic {
    const ADMIN = 0;
    const TEACHER = 1;
    const STUDENT = 2;
    const PARENT = 3;

    public static function getRoleChoices()
    {
        return [
            self::ADMIN => trans('messages.role_admin'),
            self::TEACHER => trans('messages.role_teacher'),
            self::STUDENT => trans('messages.role_student'),
            self::PARENT => trans('messages.role_parent'),
        ];
    }

    public static function getRoleText($role)
    {
        $roleList = self::getRoleChoices();
        return isset($roleList[$role]) ? $roleList[$role] : '-empty-';
    }
}


?>