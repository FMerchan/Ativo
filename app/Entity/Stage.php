<?php

namespace App;
use App\Training;


use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stage';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_stage';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Creo la relacion con la tabla.
     **/
    public function training()
    {
        return $this->belongsToMany(Training::class,'training_stage','id_stage','id_training');
    }

    /**
     * Creo la relacion con la tabla.
     **/
    public function checkpoint()
    {
        return $this->belongsToMany(Checkpoint::class,'stage_checkpoint','id_stage','id_checkpoint');
    }
}
