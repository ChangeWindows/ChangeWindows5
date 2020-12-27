<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\ChannelPlatform;
use App\Model\HorizonPlatformChannel;

class HorizonCreatePlatformChannelsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('h_platform_channels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('platform_id')->constrained('h_platforms')->onDelete('cascade');
            $table->foreignId('channel_id')->constrained('h_channels')->onDelete('cascade');
            $table->string('name');
            $table->string('short_name');
            $table->integer('active')->default(1);
            $table->timestamps();
        });

        $channel_platforms = ChannelPlatform::all();

        foreach ($channel_platforms as $channel_platform) {
            HorizonPlatformChannel::create([
                'platform_id' => $channel_platform->platform->id,
                'channel_id' => $channel_platform->channel->id,
                'name' => $channel_platform->name,
                'short_name' => $channel_platform->short_name,
                'active' => $channel_platform->active
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('h_platform_channels');
    }
}
