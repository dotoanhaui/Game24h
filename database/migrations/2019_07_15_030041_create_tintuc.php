<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTintuc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {Schema::create('tintuc', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('TieuDe');
        $table->string('TieuDeKhongDau');
        $table->string('TomTat');
        $table->mediumText('NoiDung');
        $table->string('Hinh');
        $table->integer('NoiBat');
        $table->integer('SoLuotXem');
        $table->integer('idLoaiTin');
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
        Schema::dropIfExists('tintuc');
    }
}
