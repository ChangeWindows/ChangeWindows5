<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Milestone;
use App\Model\HorizonMilestone;

class HorizonCreateMilestonesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('h_milestones', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('name');
            $table->string('codename');
            $table->string('version');
            $table->integer('canonical_version')->unsigned();
            $table->string('color');
            $table->integer('start_build')->unsigned();
            $table->date('start_preview')->nullable();
            $table->date('start_public')->nullable();
            $table->date('start_extended')->nullable();
            $table->date('start_lts')->nullable();
            $table->date('end_lts')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        $milestones = Milestone::orderBy('version', 'asc')->get();

        foreach ($milestones as $milestone) {
            HorizonMilestone::create([
                'product_name' => $milestone->osname,
                'name' => $milestone->name,
                'codename' => $milestone->codename,
                'version' => $milestone->version,
                'canonical_version' => $milestone->version,
                'color' => $milestone->color,
                'start_build' => $milestone->start_build,
                'start_preview' => $milestone->preview->timestamp === 0 ? null : $milestone->preview,
                'start_public' => $milestone->public->timestamp === 0 ? null : $milestone->public,
                'start_extended' => $milestone->mainEol->timestamp === 0 ? null : $milestone->mainEol,
                'start_lts' => $milestone->mainXol->timestamp === 0 ? null : $milestone->mainXol,
                'end_lts' => $milestone->ltsEol->timestamp === 0 ? null : $milestone->ltsEol
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('h_milestones');
    }
}
