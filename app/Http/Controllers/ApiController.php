<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{

    /**
     * Validate and get the uploaded file.
     *
     * @param string $name
     * @param \Illuminate\Http\Request|null $request
     * @return array|\Illuminate\Http\UploadedFile|null
     */
    protected function getValidatedUpload($name, $request = null)
    {
        if (is_null($request)) {
            $request = request();
        }

        if ($request->hasFile($name)) {
            if (($uploadedFile = $request->file($name)) && $uploadedFile->isValid()) {
                return $uploadedFile;
            }
        }

        return null;
    }
}
