<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;

class StylesLoaderSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('spec\Akeneo\Component\SpreadsheetParser\Xlsx\StubStyles');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\StylesLoader');
    }

    public function it_loads_shared_strings()
    {
        $this->open('path')->getPath()->shouldReturn('path');
    }
}

class StubStyles
{
    protected $path;
    public function __construct($path)
    {
        $this->path = $path;
    }
    public function getPath()
    {
        return $this->path;
    }
}
