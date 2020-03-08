<?php

namespace App\Http\Controllers;
use App\Training;
use App\Level;
use App\Duration;
use App\Distance;
use App\Stage;
use App\Checkpoint;
use App\Providers\TrainingService;

use ResponseHelper;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
	/**
	 * Busca todos los entrenamientos.
	 **/
    public function getAll()
    {
    	try {
			// Cargo los entrenamientos.
			$trainings = Training::with('distance','level','duration')->get();

			// Recorro los entrnamientos para cargar los stage.
			foreach ($trainings as $training) {
                $training = $this->loadCompletedTrainig($training, true);

			}
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse(true, 200, $trainings, "trainings");
    }

    /**
	 * Busca todos los entrenamientos por Nombre.
	 **/
    public function getByName($name = '')
    {
    	try {
    		if($name === ''){
    			return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el parametro de busqueda.") ;
    		}
			// Cargo los entrenamientos.
			$training = Training::with('distance','level','duration')->where('name' , '=', $name)->first();

			if( $training !== null )
			{
				// Recorro los entrnamientos para cargar los stage.
				$training->stage;
				foreach ($training->stage as $key => $stage) {
					$training->stage[$key]->checkpoint;
				}
			}			
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}
    	return ResponseHelper::armyResponse(true, 200, $training, '');
    }

    /**
	 * Busca todos los entrenamientos por Id.
	 **/
    public function getById($id = '')
    {
    	try {
    		if($id === ''){
    			return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el parametro de busqueda.") ;
    		}
			// Cargo los entrenamientos.
			$training = Training::with('distance','level','duration')->find($id);

			if( $training !== null )
			{
				// Recorro los entrnamientos para cargar los stage.
				$training->stage;
				foreach ($training->stage as $key => $stage) {
					$training->stage[$key]->checkpoint;
				}
			}			
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}
    	return ResponseHelper::armyResponse(true, 200, $training, '');
    }


    /**
     * Carga un entrenamiento entero.
     * */
    private function loadCompletedTrainig($training, $removeId = false, $camellCase = false)
    {
        $training->stage;
        foreach ($training->stage as $key => $stage) {
            $training->stage[$key]->checkpoint;

            foreach ($training->stage[$key]->checkpoint as $keyCheckpont => $checkpoint) {
                $this->loadCompletedCheckpoint($checkpoint, $removeId);
            }
            
            // Quito los id.
            if ($removeId){
                unset($training->stage[$key]['id_stage']);
                unset($training->stage[$key]['id_achievement']);
                unset($training->stage[$key]['pivot']);
            }
        }

        // Quito el id de entrenamiento.
        if ($removeId){
            unset($training["id_training"]);
            unset($training["id_level"]);
            unset($training["id_distance"]);
            unset($training["id_duration"]);

            unset($training->level["id_level"]);
            unset($training->distance["id_distance"]);
            unset($training->duration["id_duration"]);
        }
        return $training; 
    }

    /**
     * Carga un entrenamiento entero.
     * */
    private function loadCompletedCheckpoint($checkpoint, $removeId = false, $camellCase = false)
    {
        $checkpoint->distance;
        $checkpoint->duration;
        $checkpoint->rythmPerKm;
        // Quito el id de entrenamiento.
        if ($removeId){
            unset($checkpoint["id_checkpoint"]);
            unset($checkpoint["id_rythm_per_km"]);
            unset($checkpoint["id_distance"]);
            unset($checkpoint["id_duration"]);
            unset($checkpoint->rythmPerKm["id_rythm_per_km"]);
            if ($checkpoint->distance) {
                unset($checkpoint->distance["id_distance"]);
            }
            if ($checkpoint->duration) {
                 unset($checkpoint->duration["id_duration"]);
            }
            unset($checkpoint->pivot);

        }
    }

    function remove_keys($arr, $table) {
      $temp_array = array();
      foreach ($arr as $key => $val) {
        $object = new stdClass();
        $x = (array) $val;
        foreach ($x as $key2 => $value) {
          $new_key = str_replace($table, '', $key2);
          $object->$new_key = $value;
        }
        $temp_array[] = $object;
      }
      return $temp_array;
    }
}
