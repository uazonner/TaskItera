<?php

use Test\HTMLGenerator;

class HTMLGeneratorTest extends PHPUnit_Framework_TestCase
{
    public function test1()
    {
        $input =
            [
                [
                    'text' => 'Текст красного цвета',
                    'cells' => '1,2,4,5',
                    'align' => 'center',
                    'valign' => 'center',
                    'color' => 'FF0000',
                    'bgcolor' => '0000FF'
                ],
                [
                    'text' => 'Текст зеленого цвета',
                    'cells' => '8,9',
                    'align' => 'right',
                    'valign' => 'bottom',
                    'color' => '00FF00',
                    'bgcolor' => 'FFFFFF'
                ]
            ];

        $generator = new HTMLGenerator();
        $actualResult = $generator->processArray($input);
        $expectedResult = $this->getExpectedTable(1);
        self::assertEquals($expectedResult, $actualResult);
    }

    public function test2()
    {
        $input =
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

        $generator = new HTMLGenerator();
        $actualResult = $generator->processArray($input);
        $expectedResult = $this->getExpectedTable(2);
        self::assertEquals($expectedResult, $actualResult);
    }

    public function test3()
    {
        $input =
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

        $generator = new HTMLGenerator();
        $actualResult = $generator->processArray($input);
        $expectedResult = $this->getExpectedTable(3);
        self::assertEquals($expectedResult, $actualResult);
    }

    public function test4()
    {
        $input =
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

        $generator = new HTMLGenerator();
        $actualResult = $generator->processArray($input);
        $expectedResult = $this->getExpectedTable(4);
        self::assertEquals($expectedResult, $actualResult);
    }

    public function test5()
    {
        $input =
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

        $generator = new HTMLGenerator();
        $actualResult = $generator->processArray($input);
        $expectedResult = $this->getExpectedTable(5);
        self::assertEquals($expectedResult, $actualResult);
    }

    private function getExpectedTable($num)
    {
        $test1File = file_get_contents('data/test' . $num . '.html', FILE_USE_INCLUDE_PATH);
        $expectedHTMLResult = $this->sanitizeOutput($test1File);
        $expectedResult = strstr($expectedHTMLResult, '<table>');
        return substr($expectedResult, 0, strpos($expectedResult, "</table>") + 8);
    }

    /**
     *  http://stackoverflow.com/questions/6225351/how-to-minify-php-page-html-output
     *
     * @param $buffer
     * @return mixed
     */
    function sanitizeOutput($buffer)
    {

        $search = array(
            '~>\\s+<~m',
        );

        $replace = '><';
        $buffer = preg_replace($search, $replace, $buffer);

        return $buffer;
    }

}