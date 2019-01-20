<?php

function getSource($id) {
    switch ($id) {
        case 0:     return 'Public Release';
        case 1:     return 'Internal Leak';
        case 2:     return 'Update (GDR)';
        case 3:     return 'Update (LDR)';
        case 4:     return 'App Package';
        case 5:     return 'Build Tools';
        case 6:     return 'Documentation';
        case 7:     return 'Logging';
        case 8:     return 'Private Leak';
        default:    return;
    }
}

function getFamily($id) {
    switch ($id) {
        case 1:     return 'NT 5.0 &middot; Windows 2000';
        case 2:     return 'Neptune';
        case 3:     return 'Whistler &middot; Windows XP';
        case 4:     return 'NET Server &middot; Windows Server 2003';
        case 5:     return 'Longhorn';
        case 6:     return 'Longhorn &middot; Windows Vista';
        case 7:     return 'Windows 7';
        case 8:     return 'Windows 8';
        case 9:     return 'Windows Blue &middot; Windows 8.1';
        case 10:     return 'Threshold 1 &middot; Windows 10 version 1507';
        case 20:     return 'Threshold 2 &middot; Windows 10 version 1511';
        case 30:     return 'Redstone 1 &middot; Windows 10 version 1607';
        case 40:     return 'Redstone 2 &middot; Windows 10 version 1703';
        case 41:     return 'Redstone 2 (Feature Update) &middot; Windows 10 version 1709';
        case 50:     return 'Redstone 3 &middot; Windows 10 version 1709';
        case 60:     return 'Redstone 4 &middot; Windows 10 version 1803';
        case 70:     return 'Redstone 5 &middot; Windows 10 version 1809';
        case 80:     return '19H1 &middot; Windows 10 version 1903';
        default:    return;
    }
}