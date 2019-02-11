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
        case 1:     return 'Windows 2000';
        case 2:     return 'Neptune';
        case 3:     return 'Windows XP';
        case 4:     return 'Windows Server 2003';
        case 5:     return 'Longhorn';
        case 6:     return 'Windows Vista';
        case 7:     return 'Windows 7';
        case 8:     return 'Windows 8';
        case 9:     return 'Windows 8.1';
        case 10:     return 'Windows 10 Threshold 1 (1507)';
        case 20:     return 'Windows 10 Threshold 2 (1511)';
        case 30:     return 'Windows 10 Redstone 1 (1607)';
        case 40:     return 'Windows 10 Redstone 2 (1703)';
        case 41:     return 'Windows 10 Redstone 2 (1709, feature2)';
        case 50:     return 'Windows 10 Redstone 3 (1709)';
        case 60:     return 'Windows 10 Redstone 4 (1803)';
        case 70:     return 'Windows 10 Redstone 5 (1809)';
        case 80:     return 'Windows 10 19H1 (1903)';
        default:    return;
    }
}