<?php

namespace App\Http\Controllers;
use App\Duration;

use ResponseHelper;
use Illuminate\Http\Request;

class DurationController extends Controller
{
	/**
	 * Busca todos los entrenamientos.
	 **/
    public function getAll()
    {
    	try {
			// Cargo los entrenamientos.
			$durations = Duration::get();
			
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse(true, 200, $durations, "durations");
    }


    /**
	 * Pregunta si existe o no un duration.
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

				$status = $this->existDuration($parametros['name'], $parametros['value'], $parametros['unit']);
			}
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse($status, 200);
    }

    /**
	 * Crea un duration.
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
				if ( !$this->existDuration($parametros['name'], $parametros['value'], $parametros['unit']))
				{
					$duration = new Duration();
					// Cargo los valores.
					$duration->name = $parametros['name'];
					$duration->value = $parametros['value'];
					$duration->unit = $parametros['unit'];
					// Creo el duration
					$duration->save();
    				$status = true;
				}else{
					$message = "El duration ya existe";
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
    private function existDuration( $name, $value, $unit )
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
			$duration = Duration::where( $where )->orWhere('name', $name)->get();

			if (count($duration) > 0) {

				$return = true;
			}
		}

		return $return;
    }
}
