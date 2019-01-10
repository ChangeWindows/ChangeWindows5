<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $table = 'milestones';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['id', 'osname', 'name', 'codename', 'version', 'color', 'description', 'preview', 'public', 'mainEol', 'mainXol', 'ltsEol', 'isLts', 'pcSkip', 'pcFast', 'pcSlow', 'pcReleasePreview', 'pcTargeted', 'pcBroad', 'pcLTS', 'mobileFast', 'mobileSlow', 'mobileReleasePreview', 'mobileTargeted', 'mobileBroad', 'xboxSkip', 'xboxFast', 'xboxSlow', 'xboxPreview', 'xboxReleasePreview', 'xboxTargeted', 'serverSlow', 'serverTargeted', 'serverLTS', 'iotSlow', 'iotTargeted', 'iotBroad', 'teamTargeted', 'teamBroad', 'holographicFast', 'holographicSlow', 'holographicTargeted', 'holographicBroad', 'holographicLTS', 'sdk', 'iso'];
}
