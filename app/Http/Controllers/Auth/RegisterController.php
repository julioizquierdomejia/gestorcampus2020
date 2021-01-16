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

            if($infoUser == null){
                self::crearUsuarioGestorMoodle($data);
            }else{
                self::crearUsuarioGestorMoodle_DNI($infoUser,$data);
            }

        }else{
            self::crearUsuarioGestorMoodle($data);
        }
        
    }

    public function crearUsuarioGestorMoodle_DNI($infoUser, $data){
        $usuarioMoodle = UserCampusMoodle::create([
            'auth' => 'manual',
            'username' => $data['email'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'firstname' => $infoUser[0]->nombres,
            'lastname' => $infoUser[0]->apellido_paterno,
            'confirmed' => 1,
            'mnethostid' => 1,
        ]);

        $usuarioMoodle->save();

        self::crearUsuarioGestor_DNI($infoUser, $data);
    }

    public function crearUsuarioGestorMoodle($data){
        $usuarioMoodle = UserCampusMoodle::create([
            'auth' => 'manual',
            'username' => $data['email'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'confirmed' => 1,
            'mnethostid' => 1,
        ]);

        $usuarioMoodle->save();

        self::crearUsuarioGestor($data);
    }

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

    //grabar en la tabla usuario moodle
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


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);
        $this->guard();

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }


}
