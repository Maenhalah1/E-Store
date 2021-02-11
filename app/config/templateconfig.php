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
            'googleFonts1'   => 'https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap',
            'googleFonts2'   => 'https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap',
            'googleFonts3'   => 'https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap',
            'mainen'          => CSS_PATH .  '/main' . $_SESSION['lang'] . '.css',
        ],
        'JS' => []
    ],

    'FooterResourses' => [
        'JS' => [ 
            'main' => JS_PATH .'/main.js'
        ]
    ]

];