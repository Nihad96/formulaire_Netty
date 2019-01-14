<?php
// routing.php
$routes = [
    'contact' => [ // Controller
        ['insert', '/', ['GET', 'POST']], // action, url, HTTP method
],
    'update' => [
        ['update', '/{id}', ['GET', 'POST']]
]
];