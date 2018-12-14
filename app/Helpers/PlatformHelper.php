<?php

function getPlatformById( $id ) {
    switch ( $id ) {
        case 1:     return 'PC';
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