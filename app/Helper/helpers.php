<?php


/** Handle file upload */

function handleUpload($inputName, $model = null)
{

    try {
        if (request()->hasFile($inputName)) {

            // Model is required only when we want to update the data
            // Delete existing file
            if ($model && \File::exists(public_path($model->{$inputName}))) {
                \File::delete(public_path($model->{$inputName}));
            }

            $file = request()->file($inputName);
            // return original file name with extension
            $fileName = rand() . $file->getClientOriginalName();
            $file->move(public_path('/uploads'), $fileName);

            $filePath = "/uploads/" . $fileName;

            return $filePath;
        }
    } catch (Exception $e) {
        throw $e;
    }
}


// Delete file
function deleteFileExists($filePath)
{
    try {
        if (\File::exists(public_path($filePath))) {
            \File::delete(public_path($filePath));
        }
    } catch (\Exception $e) {
        throw $e;
    }
}


// Get dynamic colors
function getColors($index)
{
    $colors = [
        '#558bff',
        '#fecc90',
        '#ff885e',
        '#282828',
        '#190844',
        '#9dd3ff',
    ];

    return $colors[$index % count($colors)];
}
