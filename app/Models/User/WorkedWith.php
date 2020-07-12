<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkedWith extends Model
{
    use SoftDeletes;

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'name', 'profile_information_id'
    ];

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function profile_information()
    {
        $this->belongsTo(\App\Models\User\UserProfileInformation::class);
    }
}
