<?php

return [
    'Tree' => [
        'create' => 'Risk',
    	'icon' => 'fa-sitemap',
    	'route' => 'tree',
    	'type' => 'tree'
    ],
    'Risk' => [
    	'parent' => 'Tree',
        'create' => 'Attack',
        'icon' => 'fa-exclamation-circle',
    	'route' => 'risk',
    	'type' => 'risk'
    ],
    'Attack' => [
        'parent' => 'Risk',
        // 'create' => 'Defence',
    	'icon' => 'fa-bolt',
    	'route' => 'attack',
    	'type' => 'attack'
    ],
    'Defence' => [
    	'icon' => 'fa-shield',
    	'route' => 'defence',
    	'type' => 'defence'
    ]
];