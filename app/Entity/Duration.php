<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'duration';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_duration';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
