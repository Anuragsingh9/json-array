<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaveArrayDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_array_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bounce_type');
            $table->string('bounceSubType');
            $table->date('timestamp');
            $table->date('mail_timestamp');
            $table->string('name');
            $table->string('value');
            $table->string('from');
            $table->string('reply_to');
            $table->string('to');
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
        Schema::dropIfExists('save_array_data');
    }
}
