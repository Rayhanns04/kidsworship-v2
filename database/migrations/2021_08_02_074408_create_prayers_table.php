<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prayers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->foreignId("children_id")->constrained("childrens")->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId("common_time_id")->constrained("common_times")->onDelete('cascade')->onUpdate('cascade');
            $table->string("created_time");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prayers');
    }
}
