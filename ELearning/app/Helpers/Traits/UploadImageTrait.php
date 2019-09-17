<?php
namespace App\Helpers\Traits;

use Illuminate\Http\UploadedFile;

trait UploadImageTrait
{

    public function uploadAvatar($avatar)
    {
        $name = $avatar->getClientOriginalName() . time();
        $folder = '/uploads/images/avatars/';
        $filePath = $folder . $name. '.' . $avatar->getClientOriginalExtension();
        $this->uploadOne($avatar, $folder, 'public', $name);
        return $filePath;
    }

    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : str_random(25);

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }
}