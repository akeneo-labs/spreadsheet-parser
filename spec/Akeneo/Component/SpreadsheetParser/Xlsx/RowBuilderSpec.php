<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;

class RowBuilderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\RowBuilder');
    }

    public function it_builds_simple_rows()
    {
        $this->addValue(0, '0');
        $this->addValue(1, '1');
        $this->addValue(2, '2');
        $this->getData()->shouldReturn(['0', '1', '2']);
    }

    public function it_adds_missing_values()
    {
        $this->addValue(2, '2');
        $this->addValue(6, '6');
        $this->addValue(7, '7');
        $this->getData()->shouldReturn(['', '', '2', '', '', '', '6', '7']);
    }

    public function it_right_trims_empty_values()
    {
        $this->addValue(2, '2');
        $this->addValue(3, '');
        $this->addValue(4, '');
        $this->getData()->shouldReturn(['', '', '2']);
    }
}
