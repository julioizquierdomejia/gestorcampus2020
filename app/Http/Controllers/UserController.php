<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\CourseMoodle;
use Illuminate\Foundation\Auth\User as Authenticatable;


class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {   

        return Validator::make($data, [
            'document' => ['required', 'string', 'min:8' ,'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();
         
        return view('user', compact('usuario'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //

        $usuario = UserMoodle::where('id', $id);

        if($request->datauser == 1){

            $usuario->update([
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'mothers_last_name' => $request->input('mothers_last_name'),
                'sexo' => $request->input('sexo')
            ]);
        }

        if($request->datauser == 2){

            $usuario->update([
                'address' => $request->input('address'),
                'urbanizacion' => $request->input('urbanizacion'),
                'distrito' => $request->input('distrito'),
                'city' => $request->input('city'),
                'provincia' => $request->input('provincia')

            ]);
        }

        return redirect('user');

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
    }



    public function search($name)
    {

        $usuario_moodle = UserMoodle::where('name', 'LIKE', '%' . $name . '%')
            ->orWhere('id', $name)
            ->orWhere('last_name', 'LIKE', '%' . $name . '%')
            ->orWhere('document', $name )
            ->orWhere('mothers_last_name', 'LIKE', '%' . $name . '%')
            ->orWhere('distrito', 'LIKE', '%' . $name . '%')
            ->orWhere('user', 'LIKE', '%' . $name . '%')
            ->get();

        return $usuario_moodle;
        
    }


}
