<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facade\DB;
use App\Rfcs;

class RfcsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Rfcs::all();
        return response()->json(array(
            'rfcs' => $rfcs,
            'status' => 'success'
        ), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        //Guardar persona
        $rfc = new Rfcs();
        $rfc->clave = $params->clave;
        $rfc->save();
    
        $data = array(
            'rfc' => $rfc,
            'status' => 'success',
            'code' => 200,
        );
            
        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Rfcs::where('id',$id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Recoger parametrs post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        //Validar datos
        $validate = \Validator::make($params_array, [
            'name' => 'required'
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }
        // Actualizar el coche
        unset($params_array['id']);
        unset($params_array['created_at']);
        $rfc = Rfcs::where('id', $id)->update($params_array);

        $data = array(
            'rfc' => $params,
            'status' => 'success',
            'code' => 200
        );
        
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Rfcs::destroy($id);
    }
}
