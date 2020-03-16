<?php

namespace App\Http\Controllers;

use ResponseHelper;
use App\CalendarEvent;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

class CalendarEventController extends Controller
{
    /**
	 * Busca los eventos por año.
	 **/
	public function getByYear($year = '')
	{
		try {
			$year = intval($year);
			if($year === '' || !is_int($year) ){
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el parametro de busqueda.") ;
			}
			// Cargo los eventos
			$events = CalendarEvent::where(DB::raw('YEAR(date)'), '=', $year )->get();
		} catch (\Exception $e) {
			return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
		}
		return ResponseHelper::armyResponse(true, 200, $events, '');
	}


	/**
	 * Busca los eventos por año.
	 **/
	public function getByMonth($month = '')
	{
		try {
			$month = intval($month);
			if($month === '' || !is_int($month) ){
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el parametro de busqueda.") ;
			}
			// Cargo los eventos
			$events = CalendarEvent::where(DB::raw('YEAR(date)'), '=', date("Y") )
									->where(DB::raw('MONTH(date)'), '=', $month )
									->get();
		} catch (\Exception $e) {
			return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
		}
		return ResponseHelper::armyResponse(true, 200, $events, '');
	}

	/**
	 * Busca los eventos por año.
	 **/
	public function getByDay($day = '')
	{
		try {
			$day = intval($day);
			if($day === '' || !is_int($day) ){
				return ResponseHelper::armyResponse(false, 200, "Error", "Error: no se recibio el parametro de busqueda.") ;
			}
			// Cargo los eventos
			$events = CalendarEvent::where(DB::raw('YEAR(date)'), '=', date("Y") )
									->where(DB::raw('MONTH(date)'), '=', date("m") )
									->where(DB::raw('DAY(date)'), '=', $day )
									->get();
		} catch (\Exception $e) {
			return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
		}
		return ResponseHelper::armyResponse(true, 200, $events, '');
	}


	/**
	 * Busca los eventos por año.
	 **/
	public function getAll()
	{
		try {
			// Cargo los eventos
			$events = CalendarEvent::get();
		} catch (\Exception $e) {
			return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
		}
		return ResponseHelper::armyResponse(true, 200, $events, '');
	}
}
