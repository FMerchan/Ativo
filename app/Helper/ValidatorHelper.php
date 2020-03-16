<?php

namespace App\Helper;

/**
 * Clase encargada de dar funciones de validacion. 
 **/
class ValidatorHelper
{
	/**
	 * Verifica que existan los campos en un array.
	 **/
	static function ifExistKeys(array $data, array $fields)
	{
		foreach ($fields as $keyField => $field) {
			$exist = false;
			foreach ($data as $keyData => $row) {
				if ($keyField == $keyData) {
					$exist = true;
				}
			}
			if (!$exist)
			{
				return ['status' => false, "message" => "No se encontro el parametro '$keyField'"];
			}
		}
		return ['status' => true];
	}

	/**
	 * Verifica que existan los campos en un array.
	 **/
	static function checkDataType(array $data, array $fieldsType)
	{
		foreach ($fieldsType as $keyField => $type) {
			$status = true;
			$value = -99;
			// Busco el valor del campo.
			foreach ($data as $keyData => $row) {
				if ($keyField == $keyData) {
					$value = $row;
					break;
				}
			}
			// Verifico el tipo del dato.
			switch ($type) {
				case 'varchar':
					break;
				case 'int':
					if (!is_int($value)) {
						$status = false;
					}
					break;
				case 'double':
					if (!is_float($value) && !is_int($value)) {
						$status = false;
					}
					break;
				case 'bool':
					if (!is_bool($value)) {
						$status = false;
					}
					break;
				default:
					// En caso de no tener el tipo lanso error.
					throw new \Exception("ValidatorHelper: se pidio validar el tipo no configurado '$type'", 1);
					break;
			}
			// Chequeo el resultado.
			if (!$status)
			{
				return ['status' => false, "message" => "El parametro '$keyField' tiene un formato incorrecto, formato esperado '$type'"];
			}
		}
		return ['status' => true];
	}
}