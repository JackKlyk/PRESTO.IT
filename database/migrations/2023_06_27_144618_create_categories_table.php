<?php

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_it');
            $table->string('name_en');
            $table->string('name_es');
            $table->string('macro');
            $table->timestamps();

        });
        
        $categories =  [
            [
                'name_it'=>'auto',
                'name_en'=>'car',
                'name_es'=>'coche',
                'macro'=>'motori'
            ],
            [
                'name_it'=>'moto',
                'name_en'=>'motorcycle',
                'name_es'=>'motocicleta',
                'macro'=>'motori'
            ],
            [
                'name_it'=>'nautica',
                'name_en'=>'boat',
                'name_es'=>'bote',
                'macro'=>'motori'
            ],
            [
                'name_it'=>'arredamento',
                'name_en'=>'furniture',
                'name_es'=>'muebles',
                'macro'=>'immobili'
            ],
            [
                'name_it'=>'case/appartamenti',
                'name_en'=>'houses/apartments',
                'name_es'=>'casas/apartamentos',
                'macro'=>'immobili'
            ],
            [
                'name_it'=>'terreni agricoli',
                'name_en'=>'farmland',
                'name_es'=>'tierras de cultivo',
                'macro'=>'immobili'
            ],
            [
                'name_it'=>'abbigliamento',
                'name_en'=>'clothing',
                'name_es'=>'ropa',
                'macro'=>'market'
            ],
            [
                'name_it'=>'elettronica',
                'name_en'=>'electronics',
                'name_es'=>'electrónica',
                'macro'=>'market'
            ],
            [
                'name_it'=>'collezionismo',
                'name_en'=>'collecting',
                'name_es'=>'coleccionar',
                'macro'=>'market'
            ],
            [
                'name_it'=>'sport',
                'name_en'=>'sport',
                'name_es'=>'deporte',
                'macro'=>'market'
            ],

        ];

        foreach ($categories as $category) {
            Category::create(['name_it'=>$category['name_it'], 'name_en'=>$category['name_en'], 'name_es'=>$category['name_es'], 'macro'=>$category['macro']]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
