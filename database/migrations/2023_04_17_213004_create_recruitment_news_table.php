<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment_news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('master_technical_id');
            $table->unsignedBigInteger('master_level_id');
            $table->string('title');
            $table->text('description');
            $table->integer('salary');
            $table->integer('quantity');
            $table->date('expired_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade')->onUpdate('no action');
            $table->foreign('master_technical_id')->references('id')->on('master_technicals')->onDelete('cascade')->onUpdate('no action');
            $table->foreign('master_level_id')->references('id')->on('master_levels')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruitment_news');
    }
}
