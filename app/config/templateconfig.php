<?php 
return [

    'content' => [
        'startcontent'  => TEMPLATE_PATH . DS . "startcontent.php",
        'appheader'     => TEMPLATE_PATH . DS . "appheader.php" ,
        'appnav'        => TEMPLATE_PATH . DS . "appnav.php",
        'view'          => '',
        'endcontent'    => TEMPLATE_PATH . DS . "endcontent.php"
    ],

    'HeaderResourses' => [
        'CSS' => [
            'googleFonts'   => 'https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap',
            'main'          => CSS_PATH .  '/main.css'
        ],
        'JS' => []
    ],

    'FooterResourses' => [
        'JS' => [ 
            'main' => JS_PATH .'/main.js'
        ]
    ]

];