<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\CourseMoodle;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {

        $users = User::all();
        $courses = CourseMoodle::all();
        
        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        return view('home', compact('users', 'courses', 'usuario'));
    }
}
