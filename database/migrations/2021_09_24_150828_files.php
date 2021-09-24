<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Files extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->engine = 'InnoDB';	//Add this line

            $table->id();
            $table->string('path', 550);
            $table->integer('width');
            $table->integer('height');
            $table->integer('size');

            // $table->unsignedBigInteger('file_type_id');
            // $table->foreign('file_type_id')->references('id')->on('file_types')->onDelete('cascade');
            
            $table->integer('file_type_id')->unsigned();
            
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('files');
    }
}
