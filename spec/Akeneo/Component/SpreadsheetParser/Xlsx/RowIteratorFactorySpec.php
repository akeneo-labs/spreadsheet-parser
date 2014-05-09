<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

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
        ValueTransformer $valueTransformer
    ) {
        $iterator = $this->create($valueTransformer, 'path');
        $iterator->getPath()->shouldReturn('path');
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
    public function __construct($rowBuilderFactory, $columnIndexTransformer, $valueTransformer, $path)
    {
        $this->rowBuilderFactory = $rowBuilderFactory;
        $this->columnIndexTransformer = $columnIndexTransformer;
        $this->valueTransformer = $valueTransformer;
        $this->path = $path;
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
}
