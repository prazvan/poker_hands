<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GameReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('total_hands');
            $table->integer('player_1_wins');
            $table->integer('player_2_wins');
            $table->integer('ties');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_reports');
    }
}
