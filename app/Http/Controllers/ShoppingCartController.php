<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Group;
use App\Models\Tag;
use App\Models\Courseimage;
use App\Models\User;
use App\Models\UserMoodle;

use Illuminate\Support\Facades\DB;


class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = \Auth::user()->id; //auth()->id();
        $productos = ShoppingCart::where('user_id', $user_id)->get();

        $usuario = UserMoodle::where('user_id', $user_id)->first();

        $cursos = DB::table('shopping_carts')
            ->where('shopping_carts.user_id', '=', $user_id)
            ->join('courses', 'shopping_carts.course_id', '=', 'courses.id')
            ->select('courses.*', 'shopping_carts.id')
            ->get();

        $precio_total = 0;

        foreach ($cursos as $key => $curso) {
            $precio_total = $precio_total + $curso->price;
        }

        if ($productos->count() == null) {
            return redirect('/');
        }else{
            return view('carrito.index', compact('productos', 'cursos', 'usuario', 'precio_total'));
        }

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
        $id = $request->course_id;

        //analizamos si el producto ya esta en el carrito de compras
        $productos = ShoppingCart::where('course_id', $id)->first();
        
        if ($productos == null) {
            $producto = new ShoppingCart();
            $producto->user_id = $request->user_id;
            $producto->course_id = $request->course_id;
            $producto->status = 2;

            $producto->save();

            return 'Producto registrado en el carrito de compras';
        }else{
            return 'Ya esta registrado';
        }
        
        
        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        //
        $carrito = ShoppingCart::where('course_id', $request)->first();
        //$carrito = ShoppingCart::findOrFail($id);
        $carrito->delete();

        return 'Eliminado';
    }
}
