<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\State;
use App\Checkpoint;


class TrainingState extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'training_state';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_training_state';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Creo la relacion con la tabla Information.
     **/
    public function stage()
    {
        return $this->belongsTo(Stage::class, 'id_stage');
    }

    /**
     * Creo la relacion con la tabla Information.
     **/
    public function checkpoint()
    {
        return $this->belongsTo(Checkpoint::class, 'id_checkpoint');
    }
}
