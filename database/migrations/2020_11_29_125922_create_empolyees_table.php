<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpolyeesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('empolyees', function (Blueprint $table) {
      $table->id();
      $table->string('first_name', 200);
      $table->string('last_name', 200);
      $table->string('email',200);
      $table->string('phone', 100);
      $table->bigInteger('company_id')->unsigned();
      $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
      $table->integer('status')->default(0);
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
    Schema::dropIfExists('empolyees');
  }
}
