<?php

namespace  App\Http\Helpers;

trait MediaStore
{
    public function ForSingleMedia($fileName, $folderName, $mode)
    {
        if ($fileName) {
            $extOfFile = $fileName->extension();
            $newFileName = $folderName.time().'.'.$extOfFile;
            $fileName->storeAs($folderName, $newFileName, $mode);
            $fileUrl = asset("storage/$folderName/$newFileName");

            $fileArray = [
                'filename' => $newFileName,
                'fileUrl' => $fileUrl,
            ];

            return $fileArray;
        }
    }
}
