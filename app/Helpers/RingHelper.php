<?php

function getRingById($id) {
    switch ($id) {
        case 0:     return 'Leak';
        case 1:     return 'Fast Ring Skip Ahead';
        case 2:     return 'Fast Ring Active';
        case 3:     return 'Slow Ring';
        case 4:     return 'Preview Ring';
        case 5:     return 'Release Preview Ring';
        case 6:     return 'Semi-Annual Channel Targeted';
        case 7:     return 'Semi-Annual Channel Broad';
        case 8:     return 'Long-Term Suppprt Channel';
        default:    return;
    }
}

function getTweetRingById($id, $platform) {
    switch ($id) {
        case 0:
            return 'Leak';
        case 1:
            return 'Skip Ahead';
        case 2:
            switch ($platform) {
                case 1:
                    return 'Dev';
                case 3:
                    return 'Alpha';
                default:
                    return 'Fast Active';
            }
        case 3:
            switch ($platform) {
                case 1:
                case 3:
                    return 'Beta';
                case 2:
                case 5:
                    return 'Slow';
                default:
                    return 'Preview';
            }
        case 4:
            return 'Delta';
        case 5:
            switch ($platform) {
                case 3:
                    return 'Omega';
                default:
                    return 'Release Preview';
            }
        case 6:
            switch ($platform) {
                case 3:
                    return 'Production';
                case 8:
                case 9:
                    return 'Public';
                default:
                    return 'SAC';
            }
        case 7:
            return 'SAC Broad';
        case 8:
            return 'LTSC';
        default:
            return;
    }
}

function getRingClassById($id) {
    switch ($id) {
        case 0:     return 'leak';
        case 1:     return 'skip';
        case 2:     return 'fast';
        case 3:     return 'slow';
        case 4:     return 'preview';
        case 5:     return 'release';
        case 6:     return 'targeted';
        case 7:     return 'broad';
        case 8:     return 'ltsc';
        default:    return;
    }
}

function getRingIdByClass($class) {
    switch ($class) {
        case 'leak':        return 0;
        case 'skip':        return 1;
        case 'fast':        return 2;
        case 'slow':        return 3;
        case 'preview':     return 4;
        case 'release':     return 5;
        case 'targeted':    return 6;
        case 'broad':       return 7;
        case 'ltsc':        return 8;
        default:            return;
    }
}

function getRingByClass($class) {
    switch ($class) {
        case 'leak':        return 0;
        case 'skip':        return 'Fast Ring Skip Ahead';
        case 'fast':        return 'Fast Ring Active';
        case 'slow':        return 'Slow Ring';
        case 'preview':     return 'Preview Ring';
        case 'release':     return 'Release Preview Ring';
        case 'targeted':    return 'Semi-Annual Channel Targeted';
        case 'broad':       return 'Semi-Annual Channel Broad';
        case 'ltsc':        return 'Long-Term Suppprt Channel';
        default:            return 'All';
    }
}
