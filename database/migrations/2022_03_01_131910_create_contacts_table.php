<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Имя')->index();
            $table->string('phone',10)->comment('Телефон')->index();
            $table->string('email')->comment('Почта')->index();
            $table->date('created_at')->comment('Дата добавления');
            $table->bigInteger('source_id')->index();
            $table->unique([
                'phone',
                'source_id',
                'created_at',
            ], 'uniquePhone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
