<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;

class ValueTransformerFactorySpec extends ObjectBehavior
{
    public function let($dateTransformer)
    {
        $dateTransformer->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\DateTransformer');
        $this->beConstructedWith($dateTransformer, 'spec\Akeneo\Component\SpreadsheetParser\Xlsx\StubValueTransformer');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\ValueTransformerFactory');
    }

    public function it_creates_value_transformers($dateTransformer, $sharedStrings, $styles)
    {
        $sharedStrings->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\SharedStrings');
        $styles->beADoubleOf('Akeneo\Component\SpreadsheetParser\Xlsx\Styles');

        $transformer = $this->create($sharedStrings, $styles);
        $transformer->getSharedStrings()->shouldReturn($sharedStrings);
        $transformer->getDateTransformer()->shouldReturn($dateTransformer);
        $transformer->getStyles()->shouldReturn($styles);
    }
}

class StubValueTransformer
{
    protected $dateTransformer;
    protected $sharedStrings;
    protected $styles;

    public function __construct($dateTransformer, $sharedStrings, $styles)
    {
        $this->sharedStrings = $sharedStrings;
        $this->dateTransformer = $dateTransformer;
        $this->styles = $styles;
    }

    public function getSharedStrings()
    {
        return $this->sharedStrings;
    }

    public function getDateTransformer()
    {
        return $this->dateTransformer;
    }

    public function getStyles()
    {
        return $this->styles;
    }
}
