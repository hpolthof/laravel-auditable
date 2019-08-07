<?php


namespace Hpolthof\Auditable;


trait Auditable
{
    protected static function bootAuditable()
    {
        self::creating(function (self $model) {
            $model->creator()->associate(auth()->user());
        });

        self::saving(function (self $model) {
            $model->updater()->associate(auth()->user());
        });
    }

    public function creator()
    {
        return $this->belongsTo(config('auditable.user_model', 'App\\User'), 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(config('auditable.user_model', 'App\\User'), 'updated_by');
    }
}