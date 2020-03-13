<?php

namespace App;

use App\OperatorPlan;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'operator';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_operator';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Creo la relacion con la tabla distance.
     **/
    public function operatorPlan()
    {
        return $this->belongsTo('App\OperatorPlan', 'id_operator_plan');
    }
}
