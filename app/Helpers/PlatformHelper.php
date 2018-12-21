<?php

function getPlatformById($id) {
    switch ($id) {
        case 0:     return 'Generic';
        case 1:     return 'Desktop';
        case 2:     return 'Mobile';
        case 3:     return 'Xbox';
        case 4:     return 'Server';
        case 5:     return 'Holographic';
        case 6:     return 'IoT';
        case 7:     return 'Team';
        case 8:     return 'ISO';
        case 9:     return 'SDK';
        default:    return;
    }
}

function getPlatformImage($id) {
    switch ($id) {
        case 1:     return 'desktop.png';
        case 2:     return 'mobile.png';
        case 3:     return 'xbox.png';
        case 4:     return 'server.png';
        case 5:     return 'holographic.png';
        case 6:     return 'iot.png';
        case 7:     return 'team.png';
        case 8:     return 'iso.png';
        case 9:     return 'sdk.png';
        default:    return;
    }
}

function getPlatformClass($id) {
    switch ($id) {
        case 1:     return 'desktop';
        case 2:     return 'mobile';
        case 3:     return 'xbox';
        case 4:     return 'server';
        case 5:     return 'holographic';
        case 6:     return 'iot';
        case 7:     return 'team';
        case 8:     return 'iso';
        case 9:     return 'sdk';
        default:    return;
    }
}