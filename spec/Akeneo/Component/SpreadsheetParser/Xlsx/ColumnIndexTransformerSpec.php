<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;

class ColumnIndexTransformerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\ColumnIndexTransformer');
    }

    public function it_transforms_single_letter_cell_names()
    {
        $this->transform('A1')->shouldReturn(0);
        $this->transform('D360')->shouldReturn(3);
        $this->transform('F2')->shouldReturn(5);
    }

    public function it_transforms_multiple_letter_cell_names()
    {
        $this->transform('AF1')->shouldReturn(31);
        $this->transform('BC11')->shouldReturn(54);
        $this->transform('AAN125')->shouldReturn(715);
    }
}
