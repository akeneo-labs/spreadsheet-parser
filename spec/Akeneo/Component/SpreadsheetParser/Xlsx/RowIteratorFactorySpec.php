<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;

class RowIteratorFactorySpec extends ObjectBehavior
{
    public function let($rowBuilderFactory, $columnIndexTransformer)
    {
        $rowBuilderFactory->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\RowBuilderFactory');
        $columnIndexTransformer->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\ColumnIndexTransformer');

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

    public function it_creates_row_iterators($rowBuilderFactory, $columnIndexTransformer, $valueTransformer)
    {
        $valueTransformer->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\ValueTransformer');

        $iterator = $this->create($valueTransformer, 'path', ['options']);
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
