<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;
use Akeneo\Component\SpreadsheetParser\Xlsx\Spreadsheet;
use Prophecy\Argument;
use Prophecy\Exception\Prediction\UnexpectedCallsException;

class SpreadsheetSpec extends ObjectBehavior
{
    public function let(
        $relationshipsLoader,
        $sharedStringsLoader,
        $stylesLoader,
        $worksheetListReader,
        $valueTransformerFactory,
        $rowIteratorFactory,
        $archive,
        $relationships,
        $sharedStrings,
        $valueTransformer,
        $styles
    ) {
        $relationshipsLoader->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\RelationshipsLoader');
        $sharedStringsLoader->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\SharedStringsLoader');
        $stylesLoader->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\StylesLoader');
        $worksheetListReader->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\WorksheetListReader');
        $valueTransformerFactory->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\ValueTransformerFactory');
        $rowIteratorFactory->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\RowIteratorFactory');
        $archive->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\Archive');
        $relationships->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\Relationships');
        $sharedStrings->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\SharedStrings');
        $valueTransformer->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\ValueTransformer');
        $styles->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\Styles');

        $this->beConstructedWith(
            $archive,
            $relationshipsLoader,
            $sharedStringsLoader,
            $stylesLoader,
            $worksheetListReader,
            $valueTransformerFactory,
            $rowIteratorFactory
        );
        $archive->extract(Argument::type('string'))->will(
            function ($args) {
                return sprintf('temp_%s', $args[0]);
            }
        );

        $beCalledAtMostOnce = function ($calls, $object, $method) {
            if (count($calls) > 1) {
                throw new UnexpectedCallsException(
                    'Method should be called at most once',
                    $method,
                    $calls
                );
            }
        };
        $relationshipsLoader->open('temp_' . Spreadsheet::RELATIONSHIPS_PATH)
            ->should($beCalledAtMostOnce)
            ->willReturn($relationships);

        $relationships->getSharedStringsPath()->willReturn('shared_strings');
        $relationships->getStylesPath()->willReturn('styles');

        $sharedStringsLoader->open('temp_shared_strings')
            ->should($beCalledAtMostOnce)
            ->willReturn($sharedStrings);

        $stylesLoader->open(('temp_styles'))->willReturn($styles);
        $valueTransformerFactory->create($sharedStrings, $styles)->willReturn($valueTransformer);

        $worksheetListReader->getWorksheetPaths($relationships, 'temp_' . Spreadsheet::WORKBOOK_PATH)
            ->should($beCalledAtMostOnce)
            ->willReturn(['sheet1' => 'path1', 'sheet2' => 'path2']);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\Spreadsheet');
    }

    public function it_returns_the_worksheet_list()
    {
        $this->getWorksheets()->shouldReturn(['sheet1', 'sheet2']);
    }

    public function it_creates_row_iterators(
        $valueTransformer,
        $rowIteratorFactory,
        $rowIterator1,
        $rowIterator2
    ) {
        $rowIterator1->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\RowIterator');
        $rowIterator2->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\RowIterator');

        $rowIteratorFactory->create($valueTransformer, 'temp_path1', [])->willReturn($rowIterator1);
        $rowIteratorFactory->create($valueTransformer, 'temp_path2', [])->willReturn($rowIterator2);

        $this->createRowIterator(0)->shouldReturn($rowIterator1);
        $this->createRowIterator(1)->shouldReturn($rowIterator2);
    }

    public function it_finds_a_worksheet_index_by_name()
    {
        $this->getWorksheetIndex('sheet2')->shouldReturn(1);
    }

    public function it_returns_false_if_a_worksheet_does_not_exist()
    {
        $this->getWorksheetIndex('sheet3')->shouldReturn(false);
    }
}
