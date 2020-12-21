<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_ids', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE invoice_ids AUTO_INCREMENT = 543210;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_ids');
    }
}
