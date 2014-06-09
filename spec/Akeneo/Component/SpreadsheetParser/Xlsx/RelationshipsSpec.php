<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;

class RelationshipsSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(__DIR__ . '/fixtures/workbook.xml.rels');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\Relationships');
    }

    public function it_returns_worksheet_paths()
    {
        $this->getWorksheetPath('rId2')->shouldReturn('xl/worksheets/sheet1.xml');
        $this->getWorksheetPath('rId3')->shouldReturn('xl/worksheets/sheet2.xml');
        $this->getWorksheetPath('rId4')->shouldReturn('xl/worksheets/sheet3.xml');
    }

    public function it_returns_shared_strings_path()
    {
        $this->getSharedStringsPath()->shouldReturn('xl/sharedStrings.xml');
    }

    public function it_returns_styles_path()
    {
        $this->getStylesPath()->shouldReturn('xl/styles.xml');
    }
}
