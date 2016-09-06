<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;
use Akeneo\Component\SpreadsheetParser\Xlsx\Archive;
use Akeneo\Component\SpreadsheetParser\Xlsx\ColumnIndexTransformer;
use Akeneo\Component\SpreadsheetParser\Xlsx\RowBuilder;
use Akeneo\Component\SpreadsheetParser\Xlsx\RowBuilderFactory;
use Akeneo\Component\SpreadsheetParser\Xlsx\ValueTransformer;
use Prophecy\Argument;

class RowIteratorSpec extends ObjectBehavior
{
    public function let(
        RowBuilderFactory $rowBuilderFactory,
        ColumnIndexTransformer $columnIndexTransformer,
        ValueTransformer $valueTransformer,
        RowBuilder $rowBuilder,
        Archive $archive
    )
    {
        $startWith = function ($startString) {
            return function ($string) use ($startString) {
                return $startString === substr($string, 0, strlen($startString));
            };
        };
        $columnIndexTransformer->transform(Argument::that($startWith('A')))->willReturn(0);
        $columnIndexTransformer->transform(Argument::that($startWith('B')))->willReturn(1);
        $columnIndexTransformer->transform(Argument::that($startWith('C')))->willReturn(2);
        $columnIndexTransformer->transform(Argument::that($startWith('D')))->willReturn(3);

        $row = null;
        $rowBuilderFactory->create()->will(
            function () use ($rowBuilder, &$row) {
                $row = [];

                return $rowBuilder;
            }
        );

        $rowBuilder->addValue(Argument::type('int'), Argument::type('array'))->will(
            function ($args) use (&$row) {
                $row[$args[0]] = $args[1];
            }
        );
        $rowBuilder->getData()->will(
            function () use (&$row) {
                return $row;
            }
        );
        $this->beConstructedWith(
            $rowBuilderFactory,
            $columnIndexTransformer,
            $valueTransformer,
            __DIR__ . '/fixtures/sheet.xml',
            [],
            $archive
        );
        $valueTransformer->transform(Argument::type('string'), Argument::type('string'), Argument::type('string'))
            ->will(
                function ($args) {
                    return $args;
                }
            );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\RowIterator');
    }

    public function it_iterates_through_rows()
    {
        $values = [
            1 => [0 => ['0', 's', '0'], 1 => ['1', 's', '0'], 3 => ['', '', '1']],
            2 => [0 => ['2', 's', '0'], 1 => ['3', 's', '0'], 2 => ['4', 's', '0']],
            4 => [0 => ['5', 'n', '0'], 2 => ['6', 'n', '1']],
        ];

        $this->rewind();
        foreach ($values as $key => $row) {
            $this->valid()->shouldReturn(true);
            $this->current()->shouldReturn($row);
            $this->key()->shouldReturn($key);
            $this->next();
        }

        $this->valid()->shouldReturn(false);
    }

    public function it_can_be_rewinded()
    {
        $this->rewind();
        $this->valid()->shouldReturn(true);
        $this->current()->shouldReturn([0 => ['0', 's', '0'], 1 => ['1', 's', '0'], 3 => ['', '', '1']]);
        $this->key()->shouldReturn(1);
        $this->next();
        $this->rewind();
        $this->valid()->shouldReturn(true);
        $this->current()->shouldReturn([0 => ['0', 's', '0'], 1 => ['1', 's', '0'], 3 => ['', '', '1']]);
        $this->key()->shouldReturn(1);
    }
}
