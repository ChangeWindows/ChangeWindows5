<?php

function getSetting($name) {
    return 'ChangeWindows';
    // return Cache::get('settings')->where('name', $name)->first()->value;
}