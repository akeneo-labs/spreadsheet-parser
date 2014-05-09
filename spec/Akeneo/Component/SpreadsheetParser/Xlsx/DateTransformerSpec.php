<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;

class DateTransformerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\DateTransformer');
    }

    public function it_transforms_dates()
    {
        $this->transform('42001')->shouldReturnDate('2014-12-28 00:00');
        $this->transform('16.9473958333333')->shouldReturnDate('1900-01-15 22:44');
        $this->transform('37027.1041666667')->shouldReturnDate('2001-05-16 02:30');
    }

    public function getMatchers()
    {
        return [
            'returnDate' => function ($date, $expected) {
                return $expected === $date->format('Y-m-d H:i');
            }
        ];
    }
}
