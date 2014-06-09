<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;
use Akeneo\Component\SpreadsheetParser\Xlsx\Styles;

class StylesSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(__DIR__ . '/fixtures/styles.xml');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\Styles');
    }

    public function it_returns_shared_strings()
    {
        $this->get(0)->shouldReturn(Styles::FORMAT_DEFAULT);
        $this->get(1)->shouldReturn(Styles::FORMAT_DATE);
        $this->get(2)->shouldReturn(Styles::FORMAT_DEFAULT);
        $this->get(3)->shouldReturn(Styles::FORMAT_DATE);
        $this->get(4)->shouldReturn(Styles::FORMAT_DATE);
    }

    public function it_throws_an_exception_if_there_is_no_style()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringGet('bogus');
    }
}
