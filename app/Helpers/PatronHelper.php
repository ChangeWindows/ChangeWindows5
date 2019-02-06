<?php

function getPatronLevel($amount) {
    if ($amount >= 10) {
        return 'Platinum Insider';
    } elseif ($amount >= 5) {
        return 'Gold Insider';
    } elseif ($amount >= 2) {
        return 'Silver Insider';
    } else {
        return 'Bronze Insider';
    }
}