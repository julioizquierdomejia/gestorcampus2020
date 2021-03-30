<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Group;
use App\Models\Tag;
use App\Models\Courseimage;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\ShoppingCart;

use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    //
    public function index()
    {

    	$user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        $misCursos = DB::table('shopping_carts')
            ->where('shopping_carts.user_id', '=', $user_id)
            ->join('courses', 'shopping_carts.course_id', '=', 'courses.id')
            ->select('courses.*', 'shopping_carts.id')
            ->get();

        return view('perfil.index', compact('usuario', 'misCursos'));
    }
}
