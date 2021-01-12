<?php

namespace App\Http\Controllers;

use App\Models\UserMoodle;
use App\Models\User;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    //
    public function index()
    {

    	$user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        return view('perfil.index', compact('usuario'));
    }
}
