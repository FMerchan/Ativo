<?php

namespace App\Http\Controllers;
use App\Modality;
use ResponseHelper;

use Illuminate\Http\Request;

class ModalityController extends Controller
{
	/**
	 * Busca todos las Modality​.
	 **/
    public function getAll()
    {
		try {
			// Cargo las modality.
			$modalitis = Modality::all();

            foreach ($modalitis as $key => $modality) {
                unset($modalitis[$key]['id_modality']);
            }
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse(true, 200, $modalitis, "modality");
    }

    /**
	 * Busca todos los entrenamientos por Nombre.
	 **/
    public function getByName($title = '')
    {
    	try {
    		if($title === ''){
    			return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el parametro de busqueda.") ;
    		}
			// Cargo las modality.
			$modality = Modality::where('title' , '=', $title)->first();
            unset($modality['id_modality']);
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}
    	return ResponseHelper::armyResponse(true, 200, $modality, '');
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
			// Cargo las modality.
			$modality = Modality::find($id);
			unset($modality['id_modality']);
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}
    	return ResponseHelper::armyResponse(true, 200, $modality, '');
    }

    /**
     * Busca las modalidades segun la lista de parametros pasados.
     * @param  Request  $request
     * @return Response
     **/
    public function findByParameters(Request $request)
    {
        try {
            // Cargo los parametros
            $get = $request->query();

        } catch (\Exception $e) {
            return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
        }
        return ResponseHelper::armyResponse(true, 200, $modality, '');
    }
}
