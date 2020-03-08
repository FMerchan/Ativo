<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkpoint extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'checkpoint';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_checkpoint';

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
        return $this->belongsTo(RythmPerKm::class, 'id_rythm_per_km');
    }

    /**
     * Creo la relacion con la tabla.
     **/
    public function stage()
    {
        return $this->belongsToMany(Stage::class,'stage_checkpoint','id_stage','id_checkpoint');
    }
}
