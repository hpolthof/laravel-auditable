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
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}