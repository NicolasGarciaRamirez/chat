<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'member_name', 'link_profile','role_instrument','profile_information_id'
    ];

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at'
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
