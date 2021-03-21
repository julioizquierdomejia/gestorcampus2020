<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\UserCampusMoodle;
use App\Models\Log;
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
    //protected $redirectTo = RouteServiceProvider::HOME;

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


            if($infoUser == null){ // preguntamos si encuentra informacion sobre el DNI
                //si no encuentra info mandamos null
                self::crearUsuarioGestorMoodle(null,$data);
            }else{
                //si, si encuentra el DNI enviamos la info de renec
                self::crearUsuarioGestorMoodle($infoUser,$data);
            }

        }else{
            //Si el formato del DNI es distinto enviamos null
            self::crearUsuarioGestorMoodle(null,$data);
        }
        
    }


    //esta funcion registra un nuevo usuario en las tablas 
    //del gestor Tabla user y tabla usermoodle
    public function crearUsuarioGestor($infoUser, $data, $id_moodle){

        //validamos primero que la variable $infoUser
        //traiga informacion del DNI de la RENIEC
        if($infoUser == null){
            $nombre = ''; $apellido_paterno = ''; $apellido_materno = ''; $pais_domicilio = ''; $sexo = '';
            $direccion = ''; $urbanizacion = ''; $distrito = ''; $city = ''; $provincia = ''; $pais = '';

        }else{
            $nombre = $infoUser[0]->nombres;
            $apellido_paterno = $infoUser[0]->apellido_paterno;
            $apellido_materno = $infoUser[0]->apellido_materno;
            $pais_domicilio = $infoUser[0]->pais_domicilio;
            $sexo = $infoUser[0]->sexo;

            $direccion = $infoUser[0]->direccion;
            $urbanizacion = $infoUser[0]->localidad_domicilio;
            $distrito = $infoUser[0]->distrito_domicilio;
            $city = $infoUser[0]->departamento_domicilio;
            $provincia = $infoUser[0]->provincia_domicilio;
            $pais = $infoUser[0]->pais_domicilio;
        }

        //Guardamos en variables la informacion que viene 
        $apellido_paterno = $apellido_paterno;
        $apellido_materno = $apellido_materno;
        $nombres = $nombre;
        $pais_domicilio = $pais_domicilio;
        $sexo = $sexo;
        
        $direccion = $direccion;
        $urbanizacion = $urbanizacion;
        $distrito = $distrito;
        $city = $city;
        $provincia = $provincia;
        $pais = $pais;
        
        if($sexo == 1){
            $avatar = 'avatar_man.png';
        }else{
            $avatar = 'avatar_woman.png';
        }

        //Aqui registramos el usuario en la tbala user del gestor
        $user = User::create([
            'document' => $data['document'],
            'email' => $data['email'],
            'status' => 1,
            'password' => Hash::make($data['password']),
        ]);


        //Aqui registramos el uuario en la tabla usermoodle del gestor
        $userMoodle = new UserMoodle();
        $userMoodle->user_id = $user->id;

        $userMoodle->document = $data['document'];
        $userMoodle->user_moodle_id = $id_moodle;

        
        $userMoodle->user = $data['email'];
        $userMoodle->password = bcrypt($data['password']);

        $userMoodle->name = $nombres;
        $userMoodle->last_name = $apellido_paterno;
        $userMoodle->mothers_last_name = $apellido_materno;
        $userMoodle->sexo = $sexo;
        $userMoodle->avatar = $avatar;

        $userMoodle->address = $direccion;
        $userMoodle->urbanizacion = $urbanizacion;
        $userMoodle->distrito = $distrito;
        $userMoodle->city = $city;
        $userMoodle->provincia = $provincia;
        $userMoodle->country = $pais;
        

        $userMoodle->save();
        
        $user->roles()->attach(7);

        //aqui se genera un Log
        $log = Log::create([
            //return User::create([
            'user_id' => $user->id,
            'section' => 'Usuarios',
            'action' => 'Creación',
            'feedback' => 'self',
            'ip' => 'ip',
            'device' => 'device',
            'system' => 'system'
        ]);

        return $user;

    }

    //Funcion que registra al usuario en la tabla mdl_cvuser de Moodle - remoto
    public function crearUsuarioGestorMoodle($infoUser, $data){

        
        if($infoUser == null){
            $nombre = '';
            $apellido = '';
        }else{
            $nombre = $infoUser[0]->nombres;
            $apellido = $infoUser[0]->apellido_paterno;
        }

        $usuarioMoodle = UserCampusMoodle::create([
            'auth' => 'manual',
            'username' => $data['email'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'firstname' => $nombre,
            'lastname' => $apellido,
            'confirmed' => 1,
            'mnethostid' => 1,
        ]);

        $usuarioMoodle->save();

        //Una vez creado el usuario en la tabla mdl_cvuser de Moodle - remoto
        //lanzamos la funcion para registrar el usuario en las tablas user y usermood del gestor
        //le pasamos la informacion de reniec, la data del formulario, y el id del usuario moodle que acabamos de grabar
        //para que sea registrado en el  campo user_moodle_id de la tabla usermoodle del gestor
        self::crearUsuarioGestor($infoUser, $data, $usuarioMoodle->id);

        //self::crearUsuarioGestor_DNI($infoUser, $data);
    }

    

    /*    

    public function crearUsuarioGestor_DNI($infoUser, $data){
        $apellido_paterno = $infoUser[0]->apellido_paterno;
        $apellido_materno = $infoUser[0]->apellido_materno;
        $nombres = $infoUser[0]->nombres;
        $pais_domicilio = $infoUser[0]->pais_domicilio;
        $sexo = $infoUser[0]->sexo;
        
        $direccion = $infoUser[0]->direccion;
        $urbanizacion = $infoUser[0]->localidad_domicilio;
        $distrito = $infoUser[0]->distrito_domicilio;
        $city = $infoUser[0]->departamento_domicilio;
        $provincia = $infoUser[0]->provincia_domicilio;
        $pais = $infoUser[0]->pais_domicilio;
        
        if($sexo == 1){
            $avatar = 'avatar_man.png';
        }else{
            $avatar = 'avatar_woman.png';
        }

        $user = User::create([
        //return User::create([
            'document' => $data['document'],
            'email' => $data['email'],
            'status' => 1,
            'password' => Hash::make($data['password']),
        ]);


        $userMoodle = new UserMoodle();
        $userMoodle->user_id = $user->id;

        $userMoodle->document = $data['document'];
        $userMoodle->user_moodle_id = 5;

        
        $userMoodle->user = $data['email'];
        $userMoodle->password = bcrypt($data['password']);

        $userMoodle->name = $nombres;
        $userMoodle->last_name = $apellido_paterno;
        $userMoodle->mothers_last_name = $apellido_materno;
        $userMoodle->sexo = $sexo;
        $userMoodle->avatar = $avatar;

        $userMoodle->address = $direccion;
        $userMoodle->urbanizacion = $urbanizacion;
        $userMoodle->distrito = $distrito;
        $userMoodle->city = $city;
        $userMoodle->provincia = $provincia;
        $userMoodle->country = $pais;
        

        $userMoodle->save();
        

        $user->roles()->attach(7);

        //aqui se genera un Log
        $log = Log::create([
            //return User::create([
            'user_id' => $user->id,
            'section' => 'Usuarios',
            'action' => 'Creación',
            'feedback' => 'self',
            'ip' => 'ip',
            'device' => 'device',
            'system' => 'system'
        ]);

        return $user;
    }
    

    //grabar en la tabla usuario moodle del gestor laravel
    public function crearUsuarioGestor($data){
        $user = User::create([
        //return User::create([
            'document' => $data['document'],
            'email' => $data['email'],
            'status' => 1,
            'password' => Hash::make($data['password']),
        ]);

        $userMoodle = new UserMoodle();
        $userMoodle->user_id = $user->id;
        
        $userMoodle->user = $data['email'];
        $userMoodle->password = bcrypt($data['password']);

        $userMoodle->document = $data['document'];
        
        $userMoodle->name = '';
        $userMoodle->last_name = '';
        $userMoodle->mothers_last_name = '';
        $userMoodle->sexo = '';
        $userMoodle->avatar = 'avatar_man.png';

        $userMoodle->address = '';
        $userMoodle->urbanizacion = '';
        $userMoodle->distrito = '';
        $userMoodle->city = '';
        $userMoodle->provincia = '';
        $userMoodle->country = '';
        

        $userMoodle->save();


        $user->roles()->attach(7);

        //aqui se genera un Log
        $log = Log::create([
            //return User::create([
            'user_id' => $user->id,
            'section' => 'Usuarios',
            'action' => 'Creación',
            'feedback' => 'self',
            'ip' => 'ip',
            'device' => 'device',
            'system' => 'system'
        ]);

        return $user;   
    }
    
    */

}
