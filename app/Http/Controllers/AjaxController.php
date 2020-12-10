<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;


class AjaxController extends Controller
{
    public function filtrar(Request $request)
	{
		if ($request->ajax()) {

			$arr = json_decode(Storage::get('data-1.json'));

			$data = collect($arr);

			$filter = $data->when($request->input('Ciudad'), function ($q) use ($request) {
				return $q->where('Ciudad', $request->input('Ciudad'));
			})->when($request->input('Tipo'), function ($q) use ($request) {
				return $q->where('Tipo', $request->input('Tipo'));
			});

			session()->regenerate();
			$newtoken = csrf_token();

			if ($filter->count() > 0) {
				return response()->json([
					'filter' => $filter->values(),
					'total' => $filter->count(),
					'message' => $filter->count().' propiedades encontradas',
					'newtoken' => $newtoken
				], 200);
			} else {
				return response()->json([
					'filter' => $filter,
					'total' => $filter->count(),
					'message' => $filter->count().' propiedades encontradas',
					'newtoken' => $newtoken
			], 404);
			}
			
		}
	}
}
