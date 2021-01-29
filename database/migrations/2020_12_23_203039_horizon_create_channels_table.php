<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Channel;
use App\Model\HorizonChannel;

class HorizonCreateChannelsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('h_channels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->string('icon');
            $table->integer('position')->default(1);
            $table->string('slug')->unique();
            $table->timestamps();
        });

        $channels = Channel::all();

        foreach ($channels as $channel) {
            HorizonChannel::create([
                'name' => $channel->name,
                'color' => $channel->color,
                'icon' => $channel->icon,
                'position' => $channel->position,
                'active' => $channel->active
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('h_channels');
    }
}
