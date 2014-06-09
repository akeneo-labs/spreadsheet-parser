<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;

class SharedStringsSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(__DIR__ . '/fixtures/sharedStrings.xml');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\SharedStrings');
    }

    public function it_returns_shared_strings()
    {
        $this->get(0)->shouldReturn('value1');
        $this->get(2)->shouldReturn('  ');
        $this->get(4)->shouldReturn('value3');
        $this->get(5)->shouldReturn('value4');
    }

    public function it_throws_an_exception_if_there_is_no_string()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringGet(10);
    }
}
