<?php
namespace App\Services;


class FileSaveService
{

    public function handleUpload($img)
    {
        if (!is_null($img)) {

            return $img->storeAs('', time().$img->getClientOriginalName());

        } else {
            return '';
        }

    }
}