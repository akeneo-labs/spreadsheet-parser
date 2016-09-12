<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use Akeneo\Component\SpreadsheetParser\Xlsx\Archive;
use PhpSpec\ObjectBehavior;

class SharedStringsLoaderSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('spec\Akeneo\Component\SpreadsheetParser\Xlsx\StubSharedStrings');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\SharedStringsLoader');
    }

    public function it_loads_shared_strings(Archive $archive)
    {
        $sharedStrings = $this->open('path', $archive);
        $sharedStrings->getPath()->shouldReturn('path');
        $sharedStrings->getArchive()->shouldReturn($archive);
    }
}

class StubSharedStrings
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
