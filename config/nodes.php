<?php

return [
    'Tree' => [
        'create' => 'Risk',
    	'icon' => 'icon-treediagram',
    	'route' => 'tree',
    	'type' => 'tree',
        'name' => 'Assessment'
    ],
    'Risk' => [
    	'parent' => 'Tree',
        'create' => 'Attack',
        'icon' => 'icon-exclamation-sign',
    	'route' => 'risk',
    	'type' => 'risk',
        'name' => 'Risk'
    ],
    'Attack' => [
        'parent' => 'Risk',
        'create' => 'Defence',
    	'icon' => 'icon-sword',
    	'route' => 'attack',
    	'type' => 'attack',
        'name' => 'Attack'
    ],
    'Defence' => [
        'parent' => 'Attack',
    	'icon' => 'icon-securityalt-shieldalt',
    	'route' => 'defence',
    	'type' => 'defence',
        'name' => 'Defence'
    ]
];