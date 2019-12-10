<?php

function getPlatformById($id) {
    switch ($id) {
        case 0:     return 'Generic';
        case 1:     return 'PC';
        case 2:     return 'Mobile';
        case 3:     return 'Xbox';
        case 4:     return 'Server';
        case 5:     return 'Holographic';
        case 6:     return 'IoT';
        case 7:     return 'Team';
        case 8:     return 'ISO';
        case 9:     return 'SDK';
        default:    return 'Generic';
    }
}

function getPlatformIcon($id) {
    switch ($id) {
        case 1:     return '<i class="fad fa-fw fa-lg fa-desktop pc"></i>';
        case 2:     return '<i class="fad fa-fw fa-lg fa-mobile mobile"></i>';
        case 3:     return '<i class="fad fa-fw fa-lg fa-gamepad-alt fa-swap-opacity xbox"></i>';
        case 4:     return '<i class="fad fa-fw fa-lg fa-server server"></i>';
        case 5:     return '<i class="fad fa-fw fa-lg fa-head-vr holographic"></i>';
        case 6:     return '<i class="fad fa-fw fa-lg fa-microchip iot"></i>';
        case 7:     return '<i class="fad fa-fw fa-lg fa-tv-alt team"></i>';
        case 8:     return '<i class="fad fa-fw fa-lg fa-compact-disc fa-swap-opacity iso"></i>';
        case 9:     return '<i class="fad fa-fw fa-lg fa-code sdk"></i>';
        default:    return '<i class="fab fa-fw fa-lg fa-windows generic"></i>';
    }
}

function getPlatformIconNoStyle($id) {
    switch ($id) {
        case 1:     return '<i class="fad fa-fw fa-desktop"></i>';
        case 2:     return '<i class="fad fa-fw fa-mobile"></i>';
        case 3:     return '<i class="fad fa-fw fa-gamepad-alt fa-swap-opacity"></i>';
        case 4:     return '<i class="fad fa-fw fa-server"></i>';
        case 5:     return '<i class="fad fa-fw fa-head-vr"></i>';
        case 6:     return '<i class="fad fa-fw fa-microchip"></i>';
        case 7:     return '<i class="fad fa-fw fa-tv-alt"></i>';
        case 8:     return '<i class="fad fa-fw fa-compact-disc fa-swap-opacity"></i>';
        case 9:     return '<i class="fad fa-fw fa-code"></i>';
        default:    return '<i class="fab fa-fw fa-windows"></i>';
    }
}

function getPlatformClass($id) {
    switch ($id) {
        case 1:     return 'pc';
        case 2:     return 'mobile';
        case 3:     return 'xbox';
        case 4:     return 'server';
        case 5:     return 'holographic';
        case 6:     return 'iot';
        case 7:     return 'team';
        case 8:     return 'iso';
        case 9:     return 'sdk';
        default:    return 'generic';
    }
}

function getPlatformIdByClass($id) {
    switch ($id) {
        case 'pc':          return 1;
        case 'mobile':      return 2;
        case 'xbox':        return 3;
        case 'server':      return 4;
        case 'holographic': return 5;
        case 'iot':         return 6;
        case 'team':        return 7;
        case 'iso':         return 8;
        case 'sdk':         return 9;
        default:            return 0;
    }
}
