<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RythmPerKm extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rythm_per_km';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_rythm_per_km';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
