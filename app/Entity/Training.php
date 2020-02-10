<?php

namespace App;

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
}
