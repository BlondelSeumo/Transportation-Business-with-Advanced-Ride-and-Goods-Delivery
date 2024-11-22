<?php

namespace App\Models\Traits;

use Storage;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait to auto delete the old files when updating or deleting the model.
 * Set the 'deletableFiles' property to specify the attributes which hold the file names.
 * The model should also have the 'uploadPath' method which returns the path of the files.
 *
 * @package App\Models\Traits
 */
trait DeleteOldFiles
{
    /**
     * Binds updating and deleting event to auto delete the old files.
     *
     * @return void
     */
    public static function bootDeleteOldFiles()
    {
        static::updating(function (Model $model) {
            self::deleteOldFiles($model, true);
        });

        static::deleting(function (Model $model) {
            if (!method_exists($model, 'bootSoftDeletes')) {
                self::deleteOldFiles($model);
            }
        });
    }

    /**
     * Delete the old files if they're set.
     *
     * @param Model $model
     * @param bool $updating
     */
    protected static function deleteOldFiles(Model $model, $updating = false)
    {
        $attributes = $model->deletableFiles ?? [];

        if (empty($attributes)
            || !method_exists($model, 'uploadPath')
            || is_null($uploadPath = $model->uploadPath())) {
            return;
        }

        $filesToDelete = array_map(function ($attribute) use($model, $uploadPath, $updating)  {
            if (($updating && !$model->isDirty($attribute)) || is_null($value = $model->getOriginal($attribute))) {
                return null;
            }

            return file_path($uploadPath, $value);
        }, $attributes);

        Storage::delete(array_filter($filesToDelete));
    }
}
