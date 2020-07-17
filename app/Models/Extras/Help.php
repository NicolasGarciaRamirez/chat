<?php

namespace App\Models\Extras;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Help extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'subject', 'message', 'file'];

    protected $hidden = ['updated_at', 'deleted_at', 'created_at'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }
}
