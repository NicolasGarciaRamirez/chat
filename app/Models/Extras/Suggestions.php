<?php

namespace App\Models\Extras;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Suggestions
 * @package App\Models\Extras
 */
class Suggestions extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'subject', 'message', 'file'];

    /**
     * @var string[]
     */
    protected $hidden = ['updated_at', 'deleted_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

}
