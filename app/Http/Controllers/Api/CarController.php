<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

use App\User;
use App\Car;

class CarController extends Controller
{
	public function index(Request $request)
	{
		$slug = 'cars';
		$cars = Car::orderBy('id')->get();
		$dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
		return view('cars.browse', compact('cars', 'dataType'));
		// return response()->json([
		// 	'status' => 'success',
		// ]);
	}

	public function create(Request $request)
	{
		$slug = 'cars';
		$user_id = $request->get('user_id');
		$dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

		$dataTypeContent = (strlen($dataType->name) != 0) ? new $dataType->model_name() : false;

		$isModelTranslatable = is_bread_translatable($dataTypeContent);

		$view = 'cars.edit-add';
		// if (view()->exists('cars.edit-add')) {
		// 	$view = 'cars.edit-add';
		// }
		return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'user_id'));
	}

	public function store(Request $request){

		// $slug = 'cars';

		// $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

		if ($request->ajax()) return;


		$newcar = Car::create([
			'Make' => $request->get('Make'),
			'Model' => $request->get('Model'),
			'Color' => $request->get('Color'),
			'Milage' => $request->get('Milage'),
			'Year' => $request->get('Year'),
			'Type' => $request->get('Type'),
			'Pricing' => $request->get('Pricing'),
			'VIN_Number' => $request->get('VIN_Number'),
		]);



		if ($newcar) {
			return redirect()
				->route('cars.index')
				->with([
					'message' => "Successfully Added New Car",
					'alert-type' => 'success',
				]);
		}

	}

	public function search(Request $request) {
		$year = $request->get('Year');
		$type = $request->get('Type');
		$price = $request->get('Price');

		$result = Car::where('Year', '=', $year)->where('Type', '=', $type)->get();

		return response()->json([
			'status' => 'sucess',
			'car' => $result,
		]);
	}
}