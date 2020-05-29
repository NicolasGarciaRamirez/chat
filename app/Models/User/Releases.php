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
        'album_name','artitstic_name','genre','image', 'label', 'release_date'
    ];

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at','delete_at'
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
