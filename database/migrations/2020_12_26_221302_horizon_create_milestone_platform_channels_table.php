<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\ChannelMilestonePlatform;
use App\Model\HorizonMilestonePlatformChannel;
use App\Model\HorizonMilestone;
use App\Model\HorizonPlatform;
use App\Model\HorizonChannel;
use App\Model\HorizonPlatformChannel;
use App\Model\HorizonMilestonePlatform;

class HorizonCreateMilestonePlatformChannelsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up() {
            Schema::create('h_milestone_platform_channels', function (Blueprint $table) {
                $table->id();
                $table->foreignId('milestone_platform_id')->constrained('h_milestone_platforms')->onDelete('cascade');
                $table->foreignId('platform_channel_id')->constrained('h_platform_channels')->onDelete('cascade');
                $table->integer('active')->required()->default(1);
                $table->timestamps();
            });
    
            $cmps = ChannelMilestonePlatform::all();
    
            foreach ($cmps as $cmp) {
                $milestone = HorizonMilestone::where('version', '=', $cmp->milestonePlatform->milestone->version)->first();
                $platform = HorizonPlatform::where('id', '=', $cmp->milestonePlatform->platform_id)->first();
                $channel = HorizonChannel::where('id', '=', $cmp->channelPlatform->channel_id)->first();

                $platform_channel = HorizonPlatformChannel::where('platform_id', '=', $platform->id)->where('channel_id', '=',$channel->id)->first();
                $milestone_platform = HorizonMilestonePlatform::where('platform_id', '=', $platform->id)->where('milestone_id', '=', $milestone->id)->first();
    
                HorizonMilestonePlatformChannel::create([
                    'platform_channel_id' => $platform_channel->id,
                    'milestone_platform_id' => $milestone_platform->id,
                    'active' => $cmp->active
                ]);
            }
        }
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('h_milestone_platform_channels');
        }
    }