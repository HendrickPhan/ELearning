<?php
namespace App\Helpers\Traits;

use Illuminate\Http\UploadedFile;

trait UploadImageTrait
{

    public function uploadAvatar($avatar)
    {
        $name = time().$avatar->getClientOriginalName();
        $folder = '/uploads/images/avatars/';
        $filePath = $folder . $name;
        $this->uploadOne($avatar, $folder, 'public', $name);
        return $filePath;
    }

    public function uploadCertificate($image)
    {
        $name = time().$image->getClientOriginalName();
        $folder = '/uploads/images/certificates/';
        $filePath = $folder . $name;
        $this->uploadOne($image, $folder, 'public', $name);
        return $filePath;
    }

    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : str_random(25);

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }
}