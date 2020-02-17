<?php

namespace App\Http\Controllers;
use App\Training;
use App\Level;
use App\Duration;
use App\Distance;
use App\Stage;
use App\Checkpoint;

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
				$training->stage;
				foreach ($training->stage as $key => $stage) {
					$training->stage[$key]->checkpoint;
				}
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
}
