<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'achievement';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_achievement';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
