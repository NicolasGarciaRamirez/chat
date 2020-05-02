<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserPersonalInformation extends Model
{
    /**
     * Undocumented fillable
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'profile_type', 'title', 'artistic_name', 'about_you', 'members', 'releases', 'worked_with', 'genre', 'services', 'social_media'
    ];

    /**
     * Undocumented hidden
     *
     * @var array
     */
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    /**
     * relation user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }
}
