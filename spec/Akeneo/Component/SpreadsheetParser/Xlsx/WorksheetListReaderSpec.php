<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use Akeneo\Component\SpreadsheetParser\Xlsx\Relationships;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WorksheetListReaderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\WorksheetListReader');
    }

    public function it_returns_worksheet_paths(Relationships $relationships)
    {
        $relationships->getWorksheetPath(\Prophecy\Argument::type('string'))->will(
            function ($args) {
                return 'file_' . $args[0];
            }
        );
        $this->getWorksheetPaths($relationships, __DIR__ . '/fixtures/workbook.xml')->shouldReturn(
            [
                'Worksheet1' => 'file_rId2',
                'Worksheet2' => 'file_rId3',
                'Worksheet3' => 'file_rId4',
            ]
        );
    }
}
