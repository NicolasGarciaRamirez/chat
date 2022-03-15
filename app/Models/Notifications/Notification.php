<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Notification
 * @package App\Models\Notifications
 */
class Notification extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['body', 'is_viewed', 'user_id', 'notification_user_id' ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    /**
     * @return HasOne
     */
    public function user_notifiable(): HasOne
    {
        return $this->hasOne('\App\Models\User\User', 'id' , 'notification_user_id');
    }
}
