<?php

namespace App\Models\Reactions;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Supports
 * @package App\Models\Reactions
 */
class Supports extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['user_id','monthly_amount','monthly_amount_recibed','supporting_user'];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string[]
     */
    protected $appends = ['start_date'];

    /**
     * @return string
     */
    public function getStartDateAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d/m/Y');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\Models\User\User', 'supporting_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supporting()
    {
        return $this->belongsTo('\App\Models\User\User', 'user_id');
    }
}
