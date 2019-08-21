<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Helpers\JwtAuth;
use App\Http\Requests;
use Illuminate\Support\Facade\DB;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::all();
        return response()->json(array(
            'users' => $users,
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

        $user = new User();
        $user->latitude = $params->latitude;
        $user->longitude = $params->longitude;

        //Guardar usuario
        $user->save();

        $data = array(
            'user' => $user,
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
        return User::where('id', $id)->get();
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
        /*
        //Recoger parametrs post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        //Validar datos
        $validate = \Validator::make($params_array, [
            'name' => 'required'
        ]);

        if ($validate->fails()) {
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
        */
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
        User::destroy($id);
    }

    public function login(Request $request)
    {
        /*
        $jwtAuth = new JwtAuth();

        //Recibir POST
        $json = $request->input('json', null);
        $params = json_decode($json);

        $email = (!is_null($json) && isset($params->email)) ? $params->email : null;
        $password = (!is_null($json) && isset($params->password)) ? $params->password : null;
        $getToken = (!is_null($json) && isset($params->gettoken) && $params->gettoken == true) ? $params->gettoken : null;

        //Cifrar la password
        $pwd = hash('sha256', $password);

        if (!is_null($email) && !is_null($password) && ($getToken == null || $getToken == 'false')) {
            $signup = $jwtAuth->signup($email, $pwd);
        } elseif ($getToken != null) {
            //var_dump($getToken); die();
            $signup = $jwtAuth->signup($email, $pwd, $getToken);
        } else {
            $signup = array(
                'status' => 'error',
                'message' => 'Envia tus datos por post'
            );
        }

        return response()->json($signup, 200);
        */
    }
}
