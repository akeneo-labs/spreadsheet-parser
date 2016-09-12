<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use Akeneo\Component\SpreadsheetParser\Xlsx\Archive;
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

    public function it_loads_styles(Archive $archive)
    {
        $styles = $this->open('path', $archive);
        $styles->getPath()->shouldReturn('path');
        $styles->getArchive()->shouldReturn($archive);
    }
}

class StubStyles
{
    protected $path;
    private $archive;

    public function __construct($path, Archive $archive)
    {
        $this->path = $path;
        $this->archive = $archive;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getArchive()
    {
        return $this->archive;
    }
}
