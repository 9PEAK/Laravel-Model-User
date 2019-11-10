<?php

namespace Peak\Model\User;

trait Event
{

    protected static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            $model->type = static::TYPE;
        });
    }

}
