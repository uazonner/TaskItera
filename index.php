<?php
include 'vendor/autoload.php';
use Test\HTMLGenerator;

/* Create array with test data */

$input =
    [
        [
            'text' => 'Текст красного цвета',
            'cells' => '2,5,1,4',
            'align' => 'center',
            'valign' => 'center',
            'color' => 'FF0000',
            'bgcolor' => '0000FF'
        ],
        [
            'text' => 'Текст зеленого цвета',
            'cells' => '9,8',
            'align' => 'right',
            'valign' => 'bottom',
            'color' => '00FF00',
            'bgcolor' => 'FFFFFF'
        ]
    ];
$input2 =
    [
        [
            'text' => 'Текст красного цвета',
            'cells' => '5',
            'align' => 'center',
            'valign' => 'center',
            'color' => 'FF0000',
            'bgcolor' => '0000FF'
        ]
    ];
$input3 =
    [
        [
            'text' => 'Текст красного цвета',
            'cells' => '4,5,7,8',
            'align' => 'center',
            'valign' => 'center',
            'color' => 'FF0000',
            'bgcolor' => 'F0F4C3'
        ],
        [
            'text' => 'Текст синего цвета',
            'cells' => '3,6',
            'align' => 'left',
            'valign' => 'center',
            'color' => '065AE0',
            'bgcolor' => 'FFFFFF'
        ]
    ];
$input4 =
    [
        [
            'text' => 'Текст красного цвета',
            'cells' => '1,2,3,4,5,6,7,8,9',
            'align' => 'center',
            'valign' => 'center',
            'color' => 'FF0000',
            'bgcolor' => 'F0F4C3'
        ]
    ];
$input5 =
    [
        [
            'text' => 'Текст красного цвета',
            'cells' => '1,2,3',
            'align' => 'left',
            'valign' => 'top',
            'color' => 'FF0000',
            'bgcolor' => 'F0F4C3'
        ],
        [
            'text' => 'Текст красного цвета',
            'cells' => '4,5,6',
            'align' => 'center',
            'valign' => 'center',
            'color' => 'FF0000',
            'bgcolor' => 'F0F4C3'
        ],
        [
            'text' => 'Текст красного цвета',
            'cells' => '7,8,9',
            'align' => 'right',
            'valign' => 'bottom',
            'color' => 'FF0000',
            'bgcolor' => 'F0F4C3'
        ]
    ];

$html = new HTMLGenerator();

$content = file_get_contents('data/header.html', FILE_USE_INCLUDE_PATH);
$content .= $html->processArray($input2);
$content .= '</body></html>';

echo $content;