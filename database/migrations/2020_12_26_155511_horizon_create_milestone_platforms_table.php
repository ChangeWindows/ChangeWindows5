<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\MilestonePlatform;
use App\Model\HorizonMilestonePlatform;
use App\Milestone;
use App\Model\HorizonMilestone;

class HorizonCreateMilestonePlatformsTable extends Migration {
/**
 * Run the migrations.
 *
 * @return void
 */
    public function up() {
        Schema::create('h_milestone_platforms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('milestone_id')->constrained('h_milestones')->onDelete('cascade');
            $table->foreignId('platform_id')->constrained('h_platforms')->onDelete('cascade');
            $table->timestamps();
        });

        $milestone_platforms = MilestonePlatform::all();

        foreach ($milestone_platforms as $milestone_platform) {
            $legacy_milestone = Milestone::where('id', '=', $milestone_platform->milestone->id)->first();
            

            $h_milestone = HorizonMilestone::where('version', '=', $legacy_milestone->version)->first();

            HorizonMilestonePlatform::create([
                'milestone_id' => $h_milestone->id,
                'platform_id' => $milestone_platform->platform->id
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('h_milestone_platforms');
    }
}