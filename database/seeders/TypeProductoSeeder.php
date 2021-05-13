<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeProducto;

class TypeProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $typeProduct = new TypeProducto();
        $typeProduct->name = 'Curso de Campus';
        $typeProduct->status = '1';
        $typeProduct->save();

        $typeProduct = new TypeProducto();
        $typeProduct->name = 'Certificado';
        $typeProduct->status = '1';
        $typeProduct->save();

    }
}
