<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('todo');
            $table->boolean('completed')->default(false);
            $table->boolean('important')->default(false);
            $table->timestamp('complete_time', 0)->nullable();
            $table->timestamp('reminder_time', 0)->nullable();



            
            $table->timestamps();
        });

        // Schema::table('todos', function (Blueprint $table) {


        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
