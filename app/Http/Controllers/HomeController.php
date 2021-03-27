<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\CourseMoodle;
use Illuminate\Support\Facades\DB;


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

        $role = DB::table('role_user')->where('user_id', $user_id)->first();

        if ($role->id == 1 |  $role->id == 9) {
            return view('home', compact('users', 'courses', 'usuario'));    
        }else{
            return redirect('/');
        }

        
    }
}
