<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Csv;

use PhpSpec\ObjectBehavior;

class RowIteratorFactorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('spec\Akeneo\Component\SpreadsheetParser\Csv\StubRowIterator');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Csv\RowIteratorFactory');
    }

    public function it_creates_row_iterators()
    {
        $iterator = $this->create('path', ['options']);
        $iterator->getPath()->shouldReturn('path');
        $iterator->getOptions()->shouldReturn(['options']);
    }
}

class StubRowIterator
{
    protected $path;
    protected $options;

    public function __construct($path, $options)
    {
        $this->path = $path;
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getPath()
    {
        return $this->path;
    }
}
