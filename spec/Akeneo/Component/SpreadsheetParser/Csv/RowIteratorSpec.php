<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Csv;

use PhpSpec\ObjectBehavior;

class RowIteratorSpec extends ObjectBehavior
{
    protected $values = [
        1 => ['value', 'enclosed value', '15'],
        2 => ['', 'value2', ''],
        3 => ['é', 'è', '€']
    ];

    public function it_is_initializable()
    {
        $this->beConstructedWith('path', []);
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Csv\RowIterator');
    }

    public function it_parses_csv_files()
    {
        $this->beConstructedWith(__DIR__ . '/fixtures/test.csv', []);
        $this->rewind();
        foreach ($this->values as $i => $row) {
            $this->key()->shouldReturn($i);
            $this->valid()->shouldReturn(true);
            $this->current()->shouldReturn($row);
            $this->next();
        }
        $this->valid()->shouldReturn(false);
    }

    public function it_can_be_rewinded()
    {
        $this->beConstructedWith(__DIR__ . '/fixtures/test.csv', []);
        $this->rewind();
        $this->current()->shouldReturn($this->values[1]);
        $this->next();
        $this->rewind();
        $this->current()->shouldReturn($this->values[1]);
    }

    public function it_accepts_options()
    {
        $this->beConstructedWith(
            __DIR__ . '/fixtures/with_options.csv',
            [
                'delimiter' => '|',
                'enclosure' => "@"
            ]
        );
        $this->rewind();
        foreach ($this->values as $i => $row) {
            $this->key()->shouldReturn($i);
            $this->valid()->shouldReturn(true);
            $this->current()->shouldReturn($row);
            $this->next();
        }
        $this->valid()->shouldReturn(false);
    }

    public function it_converts_between_encodings()
    {
        $this->beConstructedWith(
            __DIR__ . '/fixtures/iso-8859-15.csv',
            [
                'encoding' => 'iso-8859-15'
            ]
        );
        $values = [1 => ['é', 'è', '€']];
        $this->rewind();
        foreach ($values as $i => $row) {
            $this->key()->shouldReturn($i);
            $this->valid()->shouldReturn(true);
            $this->current()->shouldReturn($row);
            $this->next();
        }
        $this->valid()->shouldReturn(false);
    }

    public function it_skips_converting_when_not_necessary()
    {
        $this->beConstructedWith(
            __DIR__ . '/fixtures/with_options.csv',
            [
                'delimiter' => '|',
                'enclosure' => "@",
                'encoding'  => 'UTF8'
            ]
        );
        $this->rewind();
        foreach ($this->values as $i => $row) {
            $this->key()->shouldReturn($i);
            $this->valid()->shouldReturn(true);
            $this->current()->shouldReturn($row);
            $this->next();
        }
        $this->valid()->shouldReturn(false);
    }
}
