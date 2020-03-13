<?php

namespace App;

use App\Operator;
use Illuminate\Database\Eloquent\Model;

class OperatorPlan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'operator_plan';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_operator_plan';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Creo la relacion con la tabla distance.
     **/
    public function operator()
    {
        return $this->belongsTo(operator::class, 'id_operator');
    }
}
