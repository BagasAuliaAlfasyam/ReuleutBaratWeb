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
                'Keurani Gampong',
                'Kepala Seksi Pemerintahan dan Masyarakat',
                'Kepala Seksi Pembangunan dan Pemberdayaan',
                'Keurani Cut Urusan Umum dan Perencanaan',
                'Keurani Cut Utusan Keuangan',
                'Ulee Jurong Cot Teungoh',
                'Ulee Jurong Paloh Bugak',
                'Ulee Jurong Paloh Panyang',
                'Ulee Jurong Paloh Sawang',
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
