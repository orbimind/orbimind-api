<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('uuid')->unique()->charset('utf8')->collation('utf8_general_ci');
            $table->text('connection')->charset('utf8')->collation('utf8_general_ci');
            $table->text('queue')->charset('utf8')->collation('utf8_general_ci');
            $table->longText('payload')->charset('utf8')->collation('utf8_general_ci');
            $table->longText('exception')->charset('utf8')->collation('utf8_general_ci');

            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_jobs');
    }
}