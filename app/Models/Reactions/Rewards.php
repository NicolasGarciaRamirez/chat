<?php

namespace App\Models\Reactions;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Rewards
 * @package App\Models\Reactions
 */
class Rewards extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['user_id','amount','amount_recibed','rewarding_user'];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string[]
     */
    protected $appends = ['date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\Models\User\User', 'rewarding_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rewarding()
    {
        return $this->belongsTo('\App\Models\User\User', 'user_id');
    }

    /**
     * @return string
     */
    public function getDateAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d-M-Y');
    }
}
