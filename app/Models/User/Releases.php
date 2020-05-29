<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Releases extends Model
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'album_name','artistic_name','genre','image', 'label', 'profile_information_id','release_date'
    ];

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at','delete_at','profile_information_id'
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
