<?php

namespace Test;

class HTMLGenerator
{
    public $colspan;
    public $rowspan;

    public function getRowspan($data)
    {
        $data = explode(',', $data);
        sort($data);
        $this->rowspan = count($data) / $this->colspan;
        return $this->rowspan;
    }

    public function getColspan($data)
    {
        $data = explode(',', $data);
        sort($data);
        $colspan = 1;
        for ($i = 0; $i < count($data) - 1; $i++) {
            if ($data[$i + 1] - $data[$i] == 1) {
                $colspan++;
            } else {
                break;
            }
            if ($colspan == 3) {
                break;
            }
        }

        $this->colspan = $colspan;

        return $colspan;
    }

    function processArray(array $input)
    {
        $cells = [];
        $cellNumbers = range(1, 9);

        foreach ($input as $key => $subArray) {
            foreach ($subArray as $dataKey => $dataValue) {
                if ($dataKey === 'cells') {
                    $tempCell = array_map('intval', explode(',', $dataValue));
                    sort($tempCell);
                    foreach ($tempCell as $cell) {
                        $cells[$tempCell[0]] = $subArray;
                        if (count($tempCell) > 1) {
                            $cells[$cell] = false;
                        }
                    }
                }

                foreach ($cellNumbers as $cellNumber) {
                    if (!array_key_exists($cellNumber, $cells)) {
                        $cells[$cellNumber] = true;
                    }
                }

            }
        }

        $content = '<table>';
        $tempNumber = 1;
        for ($tr = 0; $tr < 3; $tr++) {
            if (($tempNumber - 1) % 3 == 0) {
                $content .= '<tr>';
            }
            for ($td = 0; $td < 3; $td++) {
                if (is_array($cells[$tempNumber])) {
                    $colspan = '';
                    $rowspan = '';
                    if ($this->getColspan($cells[$tempNumber]['cells']) > 1) {
                        $colspan = ' colspan=' . '"' . $this->getColspan($cells[$tempNumber]['cells']) . '"';
                    }
                    if ($this->getRowspan($cells[$tempNumber]['cells']) > 1) {
                        $rowspan = ' rowspan=' . '"' . $this->getRowspan($cells[$tempNumber]['cells']) . '"';
                    }

                    $content .= '<td style=' . '"' . 'color: ' . '#' . $cells[$tempNumber]['color'] . ';"'
                        . ' bgcolor=' . '"#' . $cells[$tempNumber]['bgcolor'] . '"'
                        . ' align=' . '"' . $cells[$tempNumber]['align'] . '"'
                        . ' valign=' . '"' . $cells[$tempNumber]['valign'] . '"'
                        . $colspan . $rowspan
                        . '>' . $cells[$tempNumber]['text'] . '</td>';
                } elseif ($cells[$tempNumber] == true) {
                    $content .= '<td></td>';
                }
                $tempNumber++;
            }
            $content .= '</tr>';
        }
        $content .= '</table>';

        return $content;
    }
}