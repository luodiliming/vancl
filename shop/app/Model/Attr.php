<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attr extends Model
{
    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(static::class, 'pid', $this->getKeyName());
    }
}
