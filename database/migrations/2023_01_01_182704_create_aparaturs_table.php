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
        Schema::create('aparaturs', function (Blueprint $table) {
            $table->id();
            $table->enum('jabatan', [
                'Geuchik',
                'Sekretaris',
                'Bendahara',
                'Tuha Peut',
                'Tuha Lapan',
                'Kepala Bidang',
                'Kepala Dusun Cot Teungoh',
                'Kepala Dusun Paloh Bugak',
                'Kepala Dusun Paloh Panyang',
                'Kepala Dusun Paloh Sawang',
            ]);
            $table->string('fullname');
            $table->string('images');
            $table->year('periode');
            $table->year('demisioner');
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
        Schema::dropIfExists('aparaturs');
    }
};
