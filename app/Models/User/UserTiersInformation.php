<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserTiersInformation
 * @package App\Models\User
 */
class UserTiersInformation extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['name','description','amount','channel_id'];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at','deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel_information()
    {
        return $this->belongsTo('\App\Models\User\UserChannelInformation', 'channel_id');
    }
}
