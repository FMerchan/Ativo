<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileAchievement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile_achievement';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_profile_achievement';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Creo la relacion con la tabla achievement.
     **/
    public function achievement()
    {
        return $this->belongsTo(Achievement::class, 'id_achievement');
    }
}
