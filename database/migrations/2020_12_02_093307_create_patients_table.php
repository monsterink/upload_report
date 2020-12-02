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
            $table->string('an');
            $table->string('name');
            $table->string('age');
            $table->timestamps();
        });
        $patients = array(
            ['an' => '0100000','name' => 'นนท์ปวิธ อุดมวงศ์','age' => '24']
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
