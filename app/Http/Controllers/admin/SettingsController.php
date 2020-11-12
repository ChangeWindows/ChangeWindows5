<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use App\Timeline;
use App\Highlight;

class SettingsController extends Controller {
    public function indexGeneral() {
        $this->authorize('view_settings');

        return view('core.settings.general');
    }

    public function updateGeneral() {
        $this->authorize('edit_settings');

        Setting::where('name', 'name')->update(['value' => request('name')]);
        Setting::where('name', 'short_name')->update(['value' => request('short_name')]);
        Setting::where('name', 'slogan')->update(['value' => request('slogan')]);

        return redirect()->route('admin.settings.general')->with('status', 'All changes have been saved.');
    }
}
