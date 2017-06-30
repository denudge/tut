<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeTrackingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jira_instances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 63)->unique();
            $table->string('base_url', 127)->unique();
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 63)->unique();
            $table->string('description', 255);
            $table->string('key', 15);
            $table->integer('instance_id');
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 63)->unique();
            $table->string('description', 255);
            $table->timestamps();
        });

        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('period');
            $table->date('date');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('duration');
            $table->integer('project_id', 0);
            $table->string('ticket', 31);
            $table->integer('activity_id', 31);
            $table->string('description', 255);
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
        Schema::dropIfExists('entries');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('jira_instances');
    }
}
