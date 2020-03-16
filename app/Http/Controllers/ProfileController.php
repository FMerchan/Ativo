<?php

namespace App\Http\Controllers;

use ResponseHelper;
use App\Profile;
use App\Information;
use App\Achievement;
use App\ProfileAchievement;
use App\TrainingWithState;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

class ProfileController extends Controller
{
   	/**
	 * Crea un Profile.
	 **/
    public function create(Request $request)
    {
    	try {
    		DB::beginTransaction();
			// Cargo los datos.
			$data = $request->request->all();
			// Verifico que este el profile.
			if (!isset($data["profile"]))
			{
				throw new \Exception("No se encontro el parametro 'Profile'", 1);
			}
			
			// Seteo el profile.
			$profileData = $data["profile"]; 
			
			// Creo un profile model.
			$profileModel = new Profile();

			// Verifico los datos.
			$result = $profileModel->checkData($profileData);
			if ($result["status"] == false) {
				throw new \Exception($result["message"], 1);
			}
			
			// Creo el profile. 
			$profile = $profileModel->create($profileData);
			DB::commit();
    	} catch (\Exception $e) {
    		DB::rollback();
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse(true, 200, $profile, "profile");
    }

	/**
	 * Actualiza un profile.
	 **/
	public function update(Request $request, $number = '')
	{
		try {
    		DB::beginTransaction();
			if($number === ''){
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el parametro de busqueda.") ;
			}
			// Cargo los entrenamientos.
			$data = $request->request->all();
			// Verifico que este el profile.
			if (!isset($data["profile"]))
			{
				throw new \Exception("No se encontro el parametro 'Profile'", 1);
			}

			// Seteo el profile.
			$profileData = $data["profile"]; 
			
			// Creo un profile model.
			$profileModel = new Profile();

			// Verifico los datos.
			$result = $profileModel->checkData($profileData);
			if ($result["status"] == false) {
				throw new \Exception($result["message"], 1);
			}

			// Busco el profile.
			$prfileResult = $profileModel->getProfileWhitPhoneNumber($number);
			$profile = $profileModel->updateAll($prfileResult, $profileData);
			DB::commit();
		} catch (\Exception $e) {
    		DB::rollback();
			return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
		}
		return ResponseHelper::armyResponse(true, 200, $profile, '');
	}

	/**
	 * Busca un prifle por numero de telefono.
	 **/
	public function getByNumber($number = '')
	{
		$profile = [];
		try {
			if($number === ''){
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el parametro de busqueda.") ;
			}
			// Creo un profile model.
			$profileModel = new Profile();

			// Busco el profile.
			$prfileResult = $profileModel->getProfileWhitPhoneNumber($number);
			$profile = $profileModel->getArrayInfoProfile($prfileResult->getKey());
		} catch (\Exception $e) {
			return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
		}
		return ResponseHelper::armyResponse(true, 200, $profile, '');
	}


	// ------------------------------------------------------------------------
	// -- Apis Achievement.
	// ------------------------------------------------------------------------
	/**
	 * Busca un prifle por numero de telefono.
	 **/
	public function addAchievement(Request $request, $number = '')
	{
		try {
			
			// Verifico el numero.
			if($number === ''){
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el numero de busqueda.") ;
			}
			// Verifico los parameros.
			$parametros = $request->only(['name', 'achievement']);
			if ( (!isset($parametros['name']) || $parametros['name'] == '') &&
				 (!isset($parametros['achievement']) || $parametros['achievement'] == '')
			){
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se encontro el parametro el identificador del achievement.") ;
			}

			// Busco el logro.
			$achievement = false;
			if (isset($parametros['name']) && $parametros['name'] != '') {
				$achievement = Achievement::where('name' , '=', $parametros['name'])->first();
			}
			if (isset($parametros['achievement']) && $parametros['achievement'] != '' && !$achievement) {
				$achievement = Achievement::where('id_achievement' , '=', $parametros['achievement'])->first();
			}

			// Busco el profile con el logro.
			$profileModel 	= new Profile();
			$profile 		= $profileModel->getProfileWhitPhoneNumber($number);

			if ($profile == [] || $achievement == false) {
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: El profile o el achievement es invalido.") ;
			}

			// Verifico si el logro existe.
			$profileAchievement = ProfileAchievement::where('id_achievement', $achievement->getKey())
													->where('id_profile', $profile->getKey())
													->first();
			if ($profileAchievement)
			{
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: El usuarrio ya tiene el achievement asignado.") ;
			}
			// Creo la asociacion del nuevo logro.
			$profileAchievement = new ProfileAchievement();
			// Cargo los valores.
			$profileAchievement->id_profile 		= $profile->getKey();
			$profileAchievement->id_achievement 	= $achievement->getKey();
			$profileAchievement->date_achievement 	= date("Y-m-d H:i:s");
			// Creo el level
			$profileAchievement->save();
		} catch (\Exception $e) {
			return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
		}
		return ResponseHelper::armyResponse(true, 200);
	}

	/**
	 * Busca los Achievementde un profile
	 **/
	public function getAchievement($number = '')
	{
		try {
			
			// Verifico el numero.
			if($number === ''){
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el numero de busqueda.") ;
			}

			// Busco el profile con el logro.
			$profileModel 	= new Profile();
			$profile 		= $profileModel->getProfileWhitPhoneNumber($number);

			if ($profile == []) {
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: El profile es invalido.") ;
			}

			// Verifico si el logro existe.
			$achievements = ProfileAchievement::where('id_profile', $profile->getKey())->get();
			foreach ($achievements as $key => $value) {
				$achievements[$key]->achievement;
				unset($achievements[$key]["id_profile_achievement"]);
				unset($achievements[$key]["id_profile"]);
				unset($achievements[$key]["id_achievement"]);
			}
		} catch (\Exception $e) {
			return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
		}
		return ResponseHelper::armyResponse(true, 200, $achievements, 'achievement');
	}

	// -- Fin
	// ------------------------------------------------------------------------

	// ------------------------------------------------------------------------
	// -- Apis Training.
	// ------------------------------------------------------------------------
	/**
	 * Crea un Profile.
	 **/
    public function createTraining(Request $request, $number = '')
    {
    	try {
    		// Verifico el numero.
			if($number === ''){
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el numero de busqueda.") ;
			}
			// Cargo los parametros			
			$parametros = $request->only(['training', 'stage','checkpoint']);
			// Verifico que lleguen todos los parameros.
			if (!(isset($parametros['training']) && $parametros['training'] != '' &&
				 isset($parametros['stage']) && $parametros['stage'] != '' &&
				 isset($parametros['checkpoint']) && $parametros['checkpoint'] != '')) {
				throw new \Exception("No se recibieron todos los parametros 'training', 'stage', 'checkpoint'", 1);
			}
    		DB::beginTransaction();

			// Busco el profile.
			$profileModel 	= new Profile();
			$profile 		= $profileModel->getProfileWhitPhoneNumber($number);

			if ($profile == []) {
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: El profile es invalido.") ;
			}

			// Verifico los datos.
			$result = $profileModel->checkDataTraining($parametros);
			if ($result["status"] == false) {
				throw new \Exception($result["message"], 1);
			}

			// Creo el entrnamiento del prfile.
			$trainingWithStage = $profileModel->createTraninig($profile, $parametros);

			DB::commit();
    	} catch (\Exception $e) {
    		DB::rollback();
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse(true, 200, $trainingWithStage, "trainingWithStage");
    }


    /**
	 * Crea un Profile.
	 **/
    public function updateTraining(Request $request, $number = '')
    {
    	try {
    		// Verifico el numero.
			if($number === ''){
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el numero de busqueda.") ;
			}
			// Cargo los parametros			
			$parametros = $request->only(['training', 'stage','checkpoint']);
			// Verifico que lleguen todos los parameros.
			if (!(isset($parametros['training']) && $parametros['training'] != '' &&
				 isset($parametros['stage']) && $parametros['stage'] != '' &&
				 isset($parametros['checkpoint']) && $parametros['checkpoint'] != '')) {
				throw new \Exception("No se recibieron todos los parametros 'training', 'stage', 'checkpoint'", 1);
			}
    		DB::beginTransaction();

			// Busco el profile.
			$profileModel 	= new Profile();
			$profile 		= $profileModel->getProfileWhitPhoneNumber($number);

			if ($profile == []) {
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: El profile es invalido.") ;
			}

			// Verifico los datos.
			$result = $profileModel->checkDataTraining($parametros);
			if ($result["status"] == false) {
				throw new \Exception($result["message"], 1);
			}

			// Creo el entrnamiento del prfile.
			$trainingWithStage = $profileModel->updateTraninig($profile, $parametros);

			DB::commit();
    	} catch (\Exception $e) {
    		DB::rollback();
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse(true, 200, $trainingWithStage, "trainingWithStage");
    }

    /**
	 * Busca los Trainings de un profile
	 **/
	public function getTrainingsByNumber($number = '')
	{
		try {
			
			// Verifico el numero.
			if($number === ''){
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el numero de busqueda.") ;
			}

			// Busco el profile.
			$profileModel 	= new Profile();
			$profile 		= $profileModel->getProfileWhitPhoneNumber($number);

			if ($profile == []) {
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: El profile es invalido.") ;
			}

			// Busco los trinings..
			$trainingWithStates = TrainingWithState::where("id_profile",$profile->getKey())->get();
			$data = [];

			foreach ($trainingWithStates as $key => $trainig) {
				$data[] = $profileModel->loadProfileTrainignWithStage($profile, $trainig->id_training);
			}
		} catch (\Exception $e) {
			return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
		}
		return ResponseHelper::armyResponse(true, 200, $data, 'trainings');
	}
		
	// -- Fin
	// ------------------------------------------------------------------------
}
