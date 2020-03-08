<?php

namespace App\Helper;

/**
 * Clase encargada de armar las respuestas 
 **/
class ResponseHelper
{
	/**
	 * Arma la respuesta.
	 **/
	static function armyResponse($status = false, $code = 200, $information = '', $responseKey = '')
	{
		// Seteo la informacion.
		$response = [
			"status" => false,
		];

		// Seteo el status.
		if ($status) {
			$response["status"] = true;
		}

		// Armo la informacion de la respuesta.
		if (is_array($information) && $responseKey !== '') {
			$response[$responseKey] = $information;
		} elseif (is_array($information) && $responseKey === '') {
			$response = array_merge($response, $information);
		} elseif ($information !== '' ) {
			$responseKey = ($responseKey === "")? "information" : $responseKey;
			$response[$responseKey] = $information;
		}

		return \Response::json($response, $code);
	}

	/**
	 * Borra las key del response.
	 **/
	static function removeKey($data, $keySearch = "id_")
	{

		$data = (array)$data;
		foreach ($data as $key => $dat) {
			$dat = (array)$dat;

				// var_dump($key);

			if (is_array($dat)) {
				$data[$key] = ResponseHelper::removeKey($dat);
			} elseif (strpos($key, $keySearch)) {
				unset($data[$key]);
			}
		}
		
		return $data;
	}
}