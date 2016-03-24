<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;
use Akeneo\Component\SpreadsheetParser\Xlsx\DateTransformer;
use Akeneo\Component\SpreadsheetParser\Xlsx\SharedStrings;
use Akeneo\Component\SpreadsheetParser\Xlsx\Styles;
use Akeneo\Component\SpreadsheetParser\Xlsx\ValueTransformer;
use Prophecy\Argument;

class ValueTransformerSpec extends ObjectBehavior
{
    public function let(
        DateTransformer $dateTransformer,
        SharedStrings $sharedStrings,
        Styles $styles
    ) {
        $styles->get('1')->willReturn(Styles::FORMAT_DEFAULT);
        $styles->get('2')->willReturn(Styles::FORMAT_DATE);
        $dateTransformer->transform(Argument::type('string'))->will(
            function ($args) {
                return 'date_' . $args[0];
            }
        );
        $sharedStrings->get(Argument::type('string'))->will(
            function ($args) {
                return 'shared_' . $args[0];
            }
        );
        $this->beConstructedWith($dateTransformer, $sharedStrings, $styles);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\ValueTransformer');
    }

    public function it_transforms_shared_strings()
    {
        $this->transform('1', ValueTransformer::TYPE_SHARED_STRING, '1')->shouldReturn('shared_1');
    }

    public function it_transforms_strings()
    {
        $this->transform('string', ValueTransformer::TYPE_STRING, '1')->shouldReturn('string');
        $this->transform('string', ValueTransformer::TYPE_INLINE_STRING, '1')->shouldReturn('string');
        $this->transform('string', ValueTransformer::TYPE_ERROR, '1')->shouldReturn('string');
    }

    public function it_right_trims_strings()
    {
        $this->transform(' string   ', ValueTransformer::TYPE_STRING, '1')->shouldReturn(' string');
        $this->transform('string   ', ValueTransformer::TYPE_SHARED_STRING, '1')->shouldReturn('shared_string');
        $this->transform(' string   ', ValueTransformer::TYPE_INLINE_STRING, '1')->shouldReturn(' string');
        $this->transform(' string   ', ValueTransformer::TYPE_ERROR, '1')->shouldReturn(' string');
    }

    public function it_transforms_numbers()
    {
        $this->transform('10.2', ValueTransformer::TYPE_NUMBER, '1')->shouldReturn(10.2);
        $this->transform('10.2', '', '1')->shouldReturn(10.2);
    }

    public function it_transforms_dates()
    {
        $this->transform('1', ValueTransformer::TYPE_NUMBER, '2')->shouldReturn('date_1');
        $this->transform('1', '', '2')->shouldReturn('date_1');
    }

    public function it_transforms_boolans()
    {
        $this->transform('1', ValueTransformer::TYPE_BOOL, null)->shouldReturn(true);
        $this->transform('0', ValueTransformer::TYPE_BOOL, '1')->shouldReturn(false);
        $this->transform('', ValueTransformer::TYPE_BOOL, '1')->shouldReturn(false);
    }
}
