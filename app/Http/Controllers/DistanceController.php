<?php

namespace App\Http\Controllers;
use App\Distance;

use ResponseHelper;
use Illuminate\Http\Request;

class DistanceController extends Controller
{
 	/**
	 * Busca todos los entrenamientos.
	 **/
    public function getAll()
    {
    	try {
			// Cargo los entrenamientos.
			$distances = Distance::get();
			
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse(true, 200, $distances, "distances");
    }


    /**
	 * Pregunta si existe o no una distancia.
	 **/
    public function exist( Request $request )
    {
    	$status = false;
		try {
			$parametros = $request->only(['name', 'value','unit']);

			if ( isset($parametros['name']) && $parametros['name'] != '' &&
				 isset($parametros['value']) && $parametros['value'] != '' &&
				 isset($parametros['unit']) && $parametros['unit'] != ''
			){
				$parametros['value'] = str_replace(',', '.', $parametros['value']);

				$status = $this->existDistance($parametros['name'], $parametros['value'], $parametros['unit']);
			}
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse($status, 200);
    }

    /**
	 * Crea una distance.
	 **/
    public function crear( Request $request )
    {
    	$status = false;
    	$message = "";
		try {
			$parametros = $request->only(['name', 'value','unit']);

			if ( isset($parametros['name']) && $parametros['name'] != '' &&
				 isset($parametros['value']) && $parametros['value'] != '' &&
				 isset($parametros['unit']) && $parametros['unit'] != ''
			){
				$parametros['value'] = str_replace(',', '.', $parametros['value']);
				// SI no existe lo creo.
				if ( !$this->existDistance($parametros['name'], $parametros['value'], $parametros['unit']))
				{
					$distance = new Distance();
					// Cargo los valores.
					$distance->name = $parametros['name'];
					$distance->value = $parametros['value'];
					$distance->unit = $parametros['unit'];
					// Creo el distance
					$distance->save();
    				$status = true;
				}else{
					$message = "El distance ya existe";
				}
			}else{
				$message = "Parametros Invalidos";
			}
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse($status, 200, $message);
    }

    /**
     * Verifica si existe o no el objeto.
     **/
    private function existDistance( $name, $value, $unit )
    {
    	$return = false;
		if ( isset($name) && $name != '' &&
				isset($value) && $value != '' &&
				isset($unit) && $unit != ''
		){
			// Cargo las modality.
			$where = [
				'name' => $name,
				'value' => $value,
				'unit' => $unit,
			];
			$distance = Distance::where( $where )->orWhere('name', $name)->get();

			if (count($distance) > 0) {

				$return = true;
			}
		}

		return $return;
    }
}
