<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid();
            $table->string('user_uuid');
            $table->text('content');
            $table->json('reactions')->nullable();
            $table->boolean('is_from_user')->default(true);
            $table->timestamp('read_at')->nullable();
            $table->string('src_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
