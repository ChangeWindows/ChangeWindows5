<?php

return [
    'feeds' => [
        'main' => [
            'items' => 'App\Release@getFeedItems',
            'url' => '/feed',
            'title' => 'Flights on ChangeWindows',
            'view' => 'feed::feed',
        ],
    ],
];
