<?php

namespace App\Traits;

trait ModelAttributeTrait
{
    public static function bootCreatedUpdatedBy()
    {
        static::creating(function ($model) {
            if (!$model->isDirty('user_id')) {
                $model->user_id = auth()->id();
            }
            if (!$model->isDirty('user_id')) {
                $model->user_id = auth()->id();
            }
        });

//        static::updating(function ($model) {
//            if (!$model->isDirty('updated_by')) {
//                $model->updated_by = auth()->id();
//            }
//        });
    }

}
