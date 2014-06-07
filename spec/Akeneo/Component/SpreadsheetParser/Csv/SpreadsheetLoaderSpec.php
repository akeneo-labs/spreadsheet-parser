<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Csv;

use PhpSpec\ObjectBehavior;
use Akeneo\Component\SpreadsheetParser\Csv\RowIteratorFactory;

class SpreadsheetLoaderSpec extends ObjectBehavior
{
    public function let(
        RowIteratorFactory $rowIteratorFactory
    ) {
        $this->beConstructedWith(
            $rowIteratorFactory,
            'spec\Akeneo\Component\SpreadsheetParser\Csv\StubSpreadsheet',
            'sheet'
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Csv\SpreadsheetLoader');
    }

    public function it_creates_workbook_objects(
        RowIteratorFactory $rowIteratorFactory
    ) {
        $workbook = $this->open('path');
        $workbook->getPath()->shouldReturn('path');
        $workbook->getSheetName()->shouldReturn('sheet');
        $workbook->getRowIteratorFactory()->shouldReturn($rowIteratorFactory);
    }
}

class StubSpreadsheet
{
    protected $rowIteratorFactory;
    protected $sheetName;
    protected $path;
    public function __construct($rowIteratorFactory, $sheetName, $path)
    {
        $this->rowIteratorFactory = $rowIteratorFactory;
        $this->sheetName = $sheetName;
        $this->path = $path;
    }
    public function getRowIteratorFactory()
    {
        return $this->rowIteratorFactory;
    }
    public function getSheetName()
    {
        return $this->sheetName;
    }
    public function getPath()
    {
        return $this->path;
    }
}
