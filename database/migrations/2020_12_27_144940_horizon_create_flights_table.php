<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Release;
use App\Model\HorizonFlight;
use App\Milestone;
use App\Model\HorizonMilestone;

class HorizonCreateFlightsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('h_flights', function (Blueprint $table) {
            $table->id();
            $table->integer('major')->unsigned();
            $table->integer('minor')->unsigned();
            $table->integer('build')->unsigned();
            $table->integer('delta')->unsigned();
            $table->date('date');
            $table->foreignId('channel_id')->constrained('h_channels')->onDelete('cascade');
            $table->foreignId('milestone_id')->constrained('h_milestones')->onDelete('cascade');
            $table->foreignId('platform_id')->constrained('h_platforms')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('h_users')->onDelete('set null');
            $table->timestamps();
        });

        $releases = Release::all();

        foreach($releases as $release) {
            $legacy_milestone = Milestone::where('id', '=', $release->milestone)->first();
            $milestone = HorizonMilestone::where('version', '=', $legacy_milestone->version)->first();

            HorizonFlight::create([
                'major' => $release->major,
                'minor' => $release->minor,
                'build' => $release->build,
                'delta' => $release->delta,
                'date' => $release->date,
                'channel_id' => $release->ring,
                'platform_id' => $release->platform,
                'milestone_id' => $milestone->id,
                'user' => null
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('h_flights');
    }
}
