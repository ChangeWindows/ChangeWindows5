<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Log;
use App\Model\HorizonChangelog;
use App\Milestone;
use App\Model\HorizonMilestone;
use App\Model\HorizonMilestonePlatform;

class HorizonCreateChangelogsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('h_changelogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('milestone_platform_id')->constrained('h_milestone_platforms')->onDelete('cascade');
            $table->text('changelog');
            $table->timestamps();
        });

        $logs = Log::all();

        foreach($logs as $log) {
            $legacy_milestone = Milestone::where('id', '=', $log->milestone_id)->first();
            $milestone = HorizonMilestone::where('version', '=', $legacy_milestone->version)->first();

            $milestone_platform = HorizonMilestonePlatform::where('milestone_id', '=', $milestone->id)->where('platform_id', '=', $log->platform)->first();

            HorizonChangelog::create([
                'milestone_platform_id' => $milestone_platform->id,
                'changelog' => $log->changelog
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('h_changelogs');
    }
}
