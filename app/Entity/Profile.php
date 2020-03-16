<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Profile;
use App\Information;
use App\UserSubscription;
use App\TrainingWithStage;
use App\TrainingState;

class Profile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_profile';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Creo la relacion con la tabla Information.
     **/
    public function information()
    {
        return $this->belongsTo(Information::class, 'id_information');
    }

    /**
     * Creo la relacion con la tabla UserSubscription.
     **/
    public function userSubscription()
    {
        return $this->belongsTo(UserSubscription::class, 'id_user_subscription');
    }


    public function getProfileWhitPhoneNumber($number)
    {
        // Cargo los entrenamientos.
        $phoneNumber = PhoneNumber::where('number' , '=', $number)->first();
        if ($phoneNumber !== null) {
            $information = Information::where('id_phone_number' , '=', $phoneNumber->getKey())->first();
            if ($phoneNumber !== null) {
                $profile = Profile::where('id_profile' , '=', $information->id_profile)->first();
                if ($profile !== null) {
                    return $profile;
                }
            }
        }
        // Retorno vacio si no se encontro el profile.
        return [];
    }

    /**
     * Carga recursivamente los elementos de un profile.
     */
    public function getArrayInfoProfile($id)
    {
    	$profileData = [
    		"userSubscription" => UserSubscription::getArrayInfoByIdProfile($id, true),
    		"information" => Information::getArrayInfoByIdProfile($id, true),
    	]; 

    	return $profileData;
    }

    /**
     * Funcion que crea un profile.
     */
    public function create(array $data)
    {
		// Creo el profile
		$profile = new Profile();
		$profile->save();
		$profile->getKey();

		// Seteo los ID de de profile.
		$data["userSubscription"]["id_profile"] = $profile->getKey();
		$data["information"]["id_profile"] = $profile->getKey();

		// Creo un profile model y verifico la informacion.
		$informationModel = new Information();
		$information = $informationModel->newInformation($data["information"]);

		// Creo un profile model y verifico la informacion.
		$userSubscriptionModel = new UserSubscription();
		$userSubscription = $userSubscriptionModel->newUserSubscription($data["userSubscription"]);

		return $this->getArrayInfoProfile($profile->getKey());
    }


    /**
     * Actualiza toda la informacion del profile.
     */
    public function updateAll(Profile $profile, array $data)
    {
        // Creo un profile model y verifico la informacion.
        $informationModel = new Information();
        $information = $informationModel->updateAll($profile->getKey(), $data["information"]);
        // Creo un profile model y verifico la informacion.
        $userSubscriptionModel = new UserSubscription();
        $userSubscription = $userSubscriptionModel->updateAll($profile->getKey(), $data["userSubscription"]);
        
        return $this->getArrayInfoProfile($profile->getKey());
    }

    /**
     * Funcion que verifica que la informacion pasada sea correcta.
     */
    public function checkData(array $dataProfile)
    {
    	// Verfico que exista el userSubscription.
    	if (!isset($dataProfile["userSubscription"]))
    	{
    		return [
	    		"status" => false,
	    		"message" => "No se encontro el parametro 'userSubscription'",
    		];
    	}

    	// Verfico que exista el infomation.
    	if (!isset($dataProfile["information"]))
    	{
    		return [
	    		"status" => false,
	    		"message" => "No se encontro el parametro 'information'",
    		];
    	}

		// Creo un profile model y verifico la informacion.
		$informationModel = new Information();
		$result = $informationModel->checkData($dataProfile["information"]);
		// Verifico el resultado.
		if ($result["status"] == false) {
			return [
	    		"status" => false,
	    		"message" => "Information: " . $result["message"],
    		];
		}

		// Creo un profile model y verifico la informacion.
		$userSubscriptionModel = new UserSubscription();
		$result = $userSubscriptionModel->checkData($dataProfile["userSubscription"]);
		// Verifico el resultado.
		if ($result["status"] == false) {
			return [
	    		"status" => false,
	    		"message" => "UserSubscription: " . $result["message"],
    		];
		}

    	// Retorno el resultado.
    	return ["status" => true, "message" => ''];
    }

    // ------------------------------------------------------------------------
    // -- Funciones de majeno de entrnamieto.
    // ------------------------------------------------------------------------
    /**
     * Funcion que verifica que la informacion pasada sea correcta.
     */
    public function checkDataTraining(array $data)
    {
        // Creo un profile model y verifico la informacion.
        $training = Training::where("id_training", $data['training'])->get();

        // Verifico el resultado.
        if ( count($training) === 0 ) {
            return [
                "status" => false,
                "message" => "No se encontro el Training enviado.",
            ];
        }

        // Creo un profile model y verifico la informacion.
        $stage = Stage::where("id_stage", $data['stage'])->get();

        // Verifico el resultado.
        if ( count($stage) === 0 ) {
            return [
                "status" => false,
                "message" => "No se encontro el Stage enviado.",
            ];
        }

        // Creo un profile model y verifico la informacion.
        $checkpoint = Checkpoint::where("id_checkpoint", $data['checkpoint'])->get();

        // Verifico el resultado.
        if ( count($checkpoint) === 0 ) {
            return [
                "status" => false,
                "message" => "No se encontro el Checkpoint enviado.",
            ];
        }

        // Retorno el resultado.
        return ["status" => true, "message" => ''];
    }

    public function createTraninig( Profile $profile, array $data)
    {
        $res = TrainingWithState::where("id_profile",$profile->getKey())
                                                ->where("id_training",$data['training'])->get();
        if (count($res)){
            throw new \Exception("Ya existe el entrnamieto indicado para el usuario.", 1);
        }
        // Creo el profile
        $trainingWithState = new TrainingWithState();
        $trainingWithState->id_profile = $profile->getKey();
        $trainingWithState->date_start = date("Y-m-d H:i:s");
        $trainingWithState->date_end =  date('Y-m-d', strtotime('+5 years'));
        $trainingWithState->id_training = $data['training'];
        $trainingWithState->save();

        // Creo el profile
        $trainingState = new TrainingState();
        $trainingState->id_stage                = $data['stage'];
        $trainingState->id_checkpoint           = $data['checkpoint'];
        $trainingState->id_training_with_state  = $trainingWithState->getKey();
        $trainingState->is_current              = false;
        $trainingState->save();

        return $this->loadProfileTrainignWithStage($profile, $data['training']);
    }

    public function updateTraninig( Profile $profile, array $data)
    {
        $trainingWithState = TrainingWithState::where("id_profile",$profile->getKey())
                                                ->where("id_training",$data['training'])->first();
        // Creo el profile
        $trainingWithState->id_profile = $profile->getKey();
        $trainingWithState->date_start = date("Y-m-d H:i:s");
        $trainingWithState->date_end =  date('Y-m-d', strtotime('+5 years'));
        $trainingWithState->id_training = $data['training'];
        $trainingWithState->save();

        // Creo el profile
        $trainingState = TrainingState::where("id_training_with_state",$trainingWithState->getKey())->first();
        $trainingState->id_stage                = $data['stage'];
        $trainingState->id_checkpoint           = $data['checkpoint'];
        $trainingState->id_training_with_state  = $trainingWithState->getKey();
        $trainingState->is_current              = false;
        $trainingState->save();

        return $this->loadProfileTrainignWithStage($profile, $data['training']);
    }

    public function loadProfileTrainignWithStage(Profile $profile, $id)
    {
        $trainingWithState = TrainingWithState::where("id_profile",$profile->getKey())
                                                ->where("id_training",$id)->first();
        if ($trainingWithState != null && $trainingWithState != '')
        {
            $trainingWithState->training;
            $trainingWithState->trainingState;
            $trainingState = TrainingState::where("id_training_with_state",$trainingWithState->getKey())->first();
            $trainingState->checkpoint;
            $trainingState->stage;

            
            $data = json_decode(json_encode($trainingWithState),true);
            $data["training_with_state"] = json_decode(json_encode($trainingState),true);
            return $data;
        }
        return [];
    }
    // -- Fin
    // ------------------------------------------------------------------------
}
