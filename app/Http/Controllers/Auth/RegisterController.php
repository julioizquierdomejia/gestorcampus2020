<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserMoodle;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   

        return Validator::make($data, [
            'document' => ['required', 'string', 'min:8' ,'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        //verificamos la longitud del documento de identidad
        if(strlen($data['document']) == 8){

            $url = 'http://www.sigesin.conareme.org.pe/controlador/r3n13c.php?dni='.$data['document'];
            $json = file_get_contents($url, false );
            $infoUser =  json_decode($json);

            $apellido_paterno = $infoUser[0]->apellido_paterno;
            $apellido_materno = $infoUser[0]->apellido_materno;
            $nombres = $infoUser[0]->nombres;
            $pais_domicilio = $infoUser[0]->pais_domicilio;
            $sexo = $infoUser[0]->sexo;

            $user = User::create([
            //return User::create([
                'document' => $data['document'],
                'name' => $nombres,
                'email' => $data['email'],
                'sexo' => $sexo,
                'status' => 1,
                'avatar' => 'default.jpg',
                'password' => Hash::make($data['password']),
            ]);

            $userMoodle = new UserMoodle();
            $userMoodle->user_id = $user->id;
            
            $userMoodle->user = $data['email'];
            $userMoodle->password = bcrypt($data['password']);

            $userMoodle->name = $nombres;
            $userMoodle->last_name = $apellido_paterno;
            $userMoodle->mothers_last_name = $apellido_materno;

            $userMoodle->save();

            $user->roles()->attach(3);

            return $user;
        }else{

            $user = User::create([
            //return User::create([
                'document' => $data['document'],
                'name' => '',
                'email' => $data['email'],
                'sexo' => '',
                'status' => 1,
                'avatar' => 'default.jpg',
                'password' => Hash::make($data['password']),
            ]);

            $userMoodle = new UserMoodle();
            $userMoodle->user_id = $user->id;
            
            $userMoodle->user = $data['email'];
            $userMoodle->password = bcrypt($data['password']);

            $userMoodle->name = $nombres;
            $userMoodle->last_name = $apellido_paterno;
            $userMoodle->mothers_last_name = $apellido_materno;

            $userMoodle->save();

            $user->roles()->attach(3);

            return $user;
        }



        

        
    }
}
