<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OcCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('oc_categories')->insert([
                'name' => "Gastos Oficina"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Gastos Personal"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Servicios Basicos"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Gastos TI"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Asesorias"
                ]);
            DB::table('oc_categories')->insert([
             'name' => "Seguridad Industrial"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Seguridad y Aseo"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Gastos Administrativos"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Gastos de Servicios"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Marketing y Publicidad"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Mantenciones"
                ]);
            DB::table('oc_categories')->insert([
             'name' => "Insumos de Taller"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Compra accesorios Pompeyo"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Activo Fijo"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Puesta en Marcha"
                ]);
            DB::table('oc_categories')->insert([
                'name' => "Insumos Covid"
                ]);
    }
}
