<?php

namespace App;
use App\Level;
use App\Duration;
use App\Distance;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'training';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_training';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Creo la relacion con la tabla distance.
     **/
    public function distance()
    {
        return $this->belongsTo(distance::class, 'id_distance');
    }

    /**
     * Creo la relacion con la tabla level.
     **/
    public function level()
    {
        return $this->belongsTo(level::class, 'id_level');
    }

    /**
     * Creo la relacion con la tabla duration.
     **/
    public function duration()
    {
        return $this->belongsTo(duration::class, 'id_duration');
    }

    /**
     * Creo la relacion con la tabla.
     **/
    public function rythmPerKm()
    {
        return $this->belongsTo(duration::class, 'id_rythm_per_km');
    }

    /**
     * Creo la relacion con la tabla.
     **/
    public function stage()
    {
        return $this->belongsToMany(Stage::class,'training_stage','id_training','id_stage');
    }
}
