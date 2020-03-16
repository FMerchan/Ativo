<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Training;


class TrainingWithState extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'training_with_state';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_training_with_state';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Creo la relacion con la tabla Information.
     **/
    public function training()
    {
        return $this->belongsTo(Training::class, 'id_training');
    }
}
