<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Csv;

use PhpSpec\ObjectBehavior;
use Akeneo\Component\SpreadsheetParser\Csv\RowIterator;
use Akeneo\Component\SpreadsheetParser\Csv\RowIteratorFactory;

class SpreadsheetSpec extends ObjectBehavior
{
    public function let(RowIteratorFactory $rowIteratorFactory)
    {
        $this->beConstructedWith($rowIteratorFactory, 'sheet', 'path');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Csv\Spreadsheet');
    }

    public function it_returns_the_worksheet_list()
    {
        $this->getWorksheets()->shouldReturn(['sheet']);
    }

    public function it_creates_row_iterators(
        RowIteratorFactory $rowIteratorFactory,
        RowIterator $rowIterator1,
        RowIterator $rowIterator2
    ) {
        $rowIteratorFactory->create('path', ['options1'])->willReturn($rowIterator1);
        $rowIteratorFactory->create('path', ['options2'])->willReturn($rowIterator2);

        $this->createRowIterator(0, ['options1'])->shouldReturn($rowIterator1);
        $this->createRowIterator(1, ['options2'])->shouldReturn($rowIterator2);
    }

    public function it_finds_a_worksheet_index_by_name()
    {
        $this->getWorksheetIndex('sheet')->shouldReturn(0);
    }

    public function it_returns_false_if_a_worksheet_does_not_exist()
    {
        $this->getWorksheetIndex('sheet3')->shouldReturn(false);
    }
}
