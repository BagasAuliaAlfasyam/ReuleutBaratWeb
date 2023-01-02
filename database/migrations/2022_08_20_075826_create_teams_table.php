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
                'Waka III',
                'Sekretaris Waka I',
                'Sekretaris Waka II',
                'Sekretaris Waka III',
                'Co. Biro Kaderisasi',
                'Co. Biro Advokasi',
                'Co. Biro Keagamaan',
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
