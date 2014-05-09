<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;

class RowBuilderFactorySpec extends ObjectBehavior
{

    public function let()
    {
        $this->beConstructedWith('spec\Akeneo\Component\SpreadsheetParser\Xlsx\StubRowBuilder');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\RowBuilderFactory');
    }

    public function it_creates_row_builders()
    {
        $this->create()->shouldHaveType('spec\Akeneo\Component\SpreadsheetParser\Xlsx\StubRowBuilder');
    }
}

class StubRowBuilder
{

}
