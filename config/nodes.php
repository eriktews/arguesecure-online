<?php

return [
    'Tree' => [
        'create' => 'Risk',
    	'icon' => 'icon-treediagram',
    	'route' => 'tree',
    	'type' => 'Assessment'
    ],
    'Risk' => [
    	'parent' => 'Tree',
        'create' => 'Attack',
        'icon' => 'icon-exclamation-sign',
    	'route' => 'risk',
    	'type' => 'risk'
    ],
    'Attack' => [
        'parent' => 'Risk',
        'create' => 'Defence',
    	'icon' => 'icon-sword',
    	'route' => 'attack',
    	'type' => 'attack'
    ],
    'Defence' => [
        'parent' => 'Attack',
    	'icon' => 'icon-securityalt-shieldalt',
    	'route' => 'defence',
    	'type' => 'defence'
    ]
];