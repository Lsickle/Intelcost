<?php

namespace App\Http\Controllers;

use App\bienes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class BienesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr = json_decode(Storage::get('data-1.json'));

        $data = collect($arr);

        $guardados = bienes::all();

        return view('welcome', compact(['data', 'guardados']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {

            $validate = $request->validate([
                'Id' => 'unique:bienes,Origin'
            ],
            [
                'Id.unique' => 'Ya está en tus bienes...',
            ]);


			$arr = json_decode(Storage::get('data-1.json'));

			$data = collect($arr);

			$filter = $data->when($request->input('Id'), function ($q) use ($request) {
				return $q->where('Id', $request->input('Id'));
            });

            foreach ($filter as $key => $value) {
                $savedProperty = new bienes;
                $savedProperty->Direccion = $value->Direccion;
                $savedProperty->Ciudad = $value->Ciudad;
                $savedProperty->Telefono = $value->Telefono;
                $savedProperty->Codigo_Postal = $value->Codigo_Postal;
                $savedProperty->Tipo = $value->Tipo;
                $savedProperty->Precio = $value->Precio;
                $savedProperty->Origin = $value->Id;
                $savedProperty->save();
            }
            // return $filter[0];
            
            $total = bienes::all()->count();

			session()->regenerate();
			$newtoken = csrf_token();

			if ($filter->count() > 0) {
				return response()->json([
					'filter' => $filter->values(),
					'total' => $total,
					'message' => $filter->count().' propiedades guardada',
					'newtoken' => $newtoken
				], 200);
			} else {
				return response()->json([
                    'filter' => $filter->values(),
					'total' => $filter->values(),
					'message' => $filter->count().' propiedades guardada',
					'newtoken' => $newtoken
			], 404);
			}
			
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\bienes  $bienes
     * @return \Illuminate\Http\Response
     */
    public function show(bienes $bienes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\bienes  $bienes
     * @return \Illuminate\Http\Response
     */
    public function edit(bienes $bienes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\bienes  $bienes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bienes $bienes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\bienes  $bienes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, bienes $bienes)
    {
        if ($request->ajax()) {

            $bienes = bienes::where('Origin', $request->input('Id'));

            $bienes->delete();

			session()->regenerate();
            $newtoken = csrf_token();
            
            $total = bienes::all()->count();
				
			return response()->json([
                'Origin' => $request->input('Id'),
                'total' => $total,
                'message' => ' propiedad eliminada',
                'newtoken' => $newtoken
            ], 200);
			
			
		}
    }
}
