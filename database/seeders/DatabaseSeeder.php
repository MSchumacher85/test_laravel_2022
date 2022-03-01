<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $model = new Source();
        $model->name= 'Яндекс';
        $model->save();

        $model = new Source();
        $model->name= 'Гугл';
        $model->save();

        $model = new Source();
        $model->name= 'Рамблер';
        $model->save();

    }
}
