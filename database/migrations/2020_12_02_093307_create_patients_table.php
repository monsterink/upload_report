<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Patient;
class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->char('an',8);
            $table->char('hn',8);
            $table->string('name');
            $table->unsignedBigInteger('age');
            $table->timestamps();
        });
        $patients = array(
            ['an' => '10000000','hn' => '54048477','name' => 'นนท์ปวิธ อุดมวงศ์','age' => '25'],
            ['an' => '20000000','hn' => '54048478','name' => 'อรณิชา เพ็ชรรัตร์','age' => '24'],
            ['an' => '30000000','hn' => '54048479','name' => 'กีรติยา ไชยโกฏิ','age' => '25'],
            ['an' => '40000000','hn' => '54048480','name' => 'ณัฐวัตร เฟื่องฟู','age' => '27'],
            ['an' => '50000000','hn' => '54048481','name' => 'พรชนก อิสระวัฒนา','age' => '25']
        );
        foreach($patients as $patient){
            Patient::create($patient);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
