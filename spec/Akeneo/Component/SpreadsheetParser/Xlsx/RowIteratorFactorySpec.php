<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use Akeneo\Component\SpreadsheetParser\Xlsx\Archive;
use PhpSpec\ObjectBehavior;
use Akeneo\Component\SpreadsheetParser\Xlsx\ColumnIndexTransformer;
use Akeneo\Component\SpreadsheetParser\Xlsx\RowBuilderFactory;
use Akeneo\Component\SpreadsheetParser\Xlsx\ValueTransformer;

class RowIteratorFactorySpec extends ObjectBehavior
{
    public function let(RowBuilderFactory $rowBuilderFactory, ColumnIndexTransformer $columnIndexTransformer)
    {
        $this->beConstructedWith(
            $rowBuilderFactory,
            $columnIndexTransformer,
            'spec\Akeneo\Component\SpreadsheetParser\Xlsx\StubRowIterator'
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\RowIteratorFactory');
    }

    public function it_creates_row_iterators(
        RowBuilderFactory $rowBuilderFactory,
        ColumnIndexTransformer $columnIndexTransformer,
        ValueTransformer $valueTransformer,
        Archive $archive
    ) {
        $iterator = $this->create($valueTransformer, 'path', ['options'], $archive);
        $iterator->getPath()->shouldReturn('path');
        $iterator->getOptions()->shouldReturn(['options']);
        $iterator->getValueTransformer()->shouldReturn($valueTransformer);
        $iterator->getRowBuilderFactory()->shouldReturn($rowBuilderFactory);
        $iterator->getColumnIndexTransformer()->shouldReturn($columnIndexTransformer);
    }
}

class StubRowIterator
{
    protected $rowBuilderFactory;
    protected $columnIndexTransformer;
    protected $valueTransformer;
    protected $path;
    protected $options;

    public function __construct($rowBuilderFactory, $columnIndexTransformer, $valueTransformer, $path, $options)
    {
        $this->rowBuilderFactory = $rowBuilderFactory;
        $this->columnIndexTransformer = $columnIndexTransformer;
        $this->valueTransformer = $valueTransformer;
        $this->path = $path;
        $this->options = $options;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getValueTransformer()
    {
        return $this->valueTransformer;
    }

    public function getRowBuilderFactory()
    {
        return $this->rowBuilderFactory;
    }

    public function getColumnIndexTransformer()
    {
        return $this->columnIndexTransformer;
    }

    public function getOptions()
    {
        return $this->options;
    }
}
