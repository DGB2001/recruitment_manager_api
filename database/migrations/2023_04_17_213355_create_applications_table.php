<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('master_technical_id')->nullable();
            $table->unsignedBigInteger('master_level_id')->nullable();
            $table->unsignedBigInteger('recruitment_news_id')->nullable();
            $table->string('title');
            $table->text('content');
            $table->tinyInteger('result')->nullable()->comment('0: Fail; 1: Pass');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
            $table->foreign('master_technical_id')->references('id')->on('master_technicals')->onDelete('cascade');
            $table->foreign('master_level_id')->references('id')->on('master_levels')->onDelete('cascade');
            $table->foreign('recruitment_news_id')->references('id')->on('recruitment_news')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
