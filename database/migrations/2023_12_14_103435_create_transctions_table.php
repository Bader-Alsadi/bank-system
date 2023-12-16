<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transctions', function (Blueprint $table) {
            $table->id();
            $table->double("amount")->nullable();
            $table->foreignId("account_id")->references("id")->on("accounts")->onDelete("cascade");
            $table->foreignId("transction_type_id")->references("id")->on("transction_types")->onDelete("cascade");
            $table->foreignId("ex_account_id")->nullable()->references("id")->on("accounts")->onDelete("cascade");
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
        Schema::dropIfExists('transctions');
    }
};
