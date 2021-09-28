<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_passwords', function (Blueprint $table) {
            $table->id();
            $table->string('new_password');
            $table->string('old_password');
            $table->date('date');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('company_general_managers')->onDelete('cascade');
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
        Schema::dropIfExists('company_passwords');
    }
}
