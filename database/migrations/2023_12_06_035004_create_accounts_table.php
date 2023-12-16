<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voidsa
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string("number");
            $table->double("blance");
            $table->foreignId("type_id")->references("id")->on("accoun_types")->onDelete("cascade");
            $table->foreignId("currncy_id")->references("id")->on("currncies")->onDelete("cascade");
            $table->foreignId("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->unique(["type_id", "currncy_id"]);
            $table->boolean("is_main")->default(false);
            $table->foreignId("branch_id")->references("id")->on("branches")->onDelete("cascade");
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
        Schema::dropIfExists('accounts');
    }
};
