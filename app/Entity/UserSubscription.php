<?php

namespace App;

use App\OperatorPlan;
use App\Helper\ValidatorHelper;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_subscription';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_user_subscription';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_operator', 'id_operator_plan', 'is_valid', 'id_profile'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillableType = [
        'id_operator_plan' => 'int',
        'is_valid' => 'bool',
    ];

    /**
     * Creo la relacion con la tabla Information.
     **/
    public function operatorPlan()
    {
        return $this->belongsTo(OperatorPlan::class, 'id_operator_plan');
    }

    /**
     * Creo la relacion con la tabla Information.
     **/
    public function operator()
    {
        return $this->belongsTo(Operator::class, 'id_operator');
    }

    /**
     * Funcion para crear un nuevo objeto.
     */
    public function newUserSubscription(array $data)
    {
		// Cargo los entrenamientos.
		$operatorPlan = OperatorPlan::where('id_operator_plan' , '=', $data["id_operator_plan"])->first();
		$data["id_operator"] = $operatorPlan->id_operator; 

    	// Creo el Information
		$userSubscription = new UserSubscription();
		// Seteo los valores del inforamtion.
		$userSubscription->id_operator_plan = $data["id_operator_plan"];
		$userSubscription->is_valid 		= $data["is_valid"];
		$userSubscription->id_profile 		= $data["id_profile"];
		$userSubscription->id_operator 		= $data["id_operator"];

		// Gurdo el userSubscription.
		$userSubscription->save();
		return $userSubscription;
    }

    /**
     * Funcion para actualizar un nuevo objeto.
     */
    public function updateAll(int $idProfile, array $data)
    {
        // Cargo los entrenamientos.
        $operatorPlan = OperatorPlan::where('id_operator_plan' , '=', $data["id_operator_plan"])->first();
        $data["id_operator"] = $operatorPlan->id_operator; 

        // Creo el Information
        $userSubscription = UserSubscription::where('id_profile' , '=', $idProfile)->first();
        // Seteo los valores del inforamtion.
        $userSubscription->id_operator_plan = $data["id_operator_plan"];
        $userSubscription->is_valid         = $data["is_valid"];
        $userSubscription->id_operator      = $data["id_operator"];

        // Gurdo el userSubscription.
        $userSubscription->save();
        return $userSubscription;
    }


    /**
     * Funcion que verifica que la informacion pasada sea correcta.
     */
    public function checkData(array $dataSubscription)
    {
    	// Chequeo que esten todos los datos.
    	$result = ValidatorHelper::ifExistKeys($dataSubscription, $this->fillableType);
		if ($result["status"] == false) {
			return [
	    		"status" => false,
	    		"message" => $result["message"],
    		];
		}
		// Chequeo los parametros.
    	$result = ValidatorHelper::checkDataType($dataSubscription, $this->fillableType);
    	if ($result["status"] == false) {
			return [
	    		"status" => false,
	    		"message" => $result["message"],
    		];
		}

		// Creo un phoneNumber model y verifico la informacion.
		$operatorPlanModel = new OperatorPlan();
		$operatorPlan = $operatorPlanModel->exist($dataSubscription["id_operator_plan"]);
		// Verifico el resultado.
		if ($operatorPlan == false) {
			return [
	    		"status" => false,
	    		"message" => "El OperatorPlan enviado no existe",
    		];
		}

    	// Retorno el resultado.
    	return ["status" => true, "message" => ''];
    }

    /**
     * Funcion que devuelve la la informacion de una subscripcion en forma de array.
     */
    static function getArrayInfoByIdProfile($id, $removeId = false)
    {   
        // Cargo Information.
        $userSubscription = UserSubscription::where('id_profile' , '=', $id)->first();
        $userSubscription->operatorPlan;
        $userSubscription->operatorPlan->operator;
        $userSubscription->operator;
        // Quito los ID de la informacion.
        if ($removeId)
        {
        	unset($userSubscription["id_operator"]);
			unset($userSubscription["id_operator_plan"]);
			unset($userSubscription["id_profile"]);
			unset($userSubscription["id_user_subscription"]);
        	unset($userSubscription->operator["id_operator"]);
        	unset($userSubscription->operatorPlan["id_operator"]);
        	unset($userSubscription->operatorPlan["id_operator_plan"]);
        }
        return $userSubscription;
    }
}
