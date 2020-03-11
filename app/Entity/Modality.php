<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'modality';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_modality';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
