<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilelistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filelists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('filename');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('postalcode');
            $table->string('process_rows')->nullable();
            $table->string('dataset')->nullable();
            $table->string('table_name')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('filelists');
    }
}
