<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unit');
            $table->date('date_receive');
            $table->string('sp_receive');
            $table->unsignedSmallInteger('doc_qty');
            $table->date('date_sent');
            $table->string('sp_sent');
            $table->string('doc');
            $table->unsignedSmallInteger('retensi');
            $table->string('classification');
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
        Schema::dropIfExists('transfer_data');
    }
}
