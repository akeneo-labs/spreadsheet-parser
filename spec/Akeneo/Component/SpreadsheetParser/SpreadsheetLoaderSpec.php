<?php

namespace spec\Akeneo\Component\SpreadsheetParser;

use PhpSpec\ObjectBehavior;

class SpreadsheetLoaderSpec extends ObjectBehavior
{
    public function let($loader, $otherLoader, $spreadsheet)
    {
        $loader->beADoubleOf('Akeneo\Component\SpreadsheetParser\SpreadsheetLoaderInterface');
        $otherLoader->beADoubleOf('Akeneo\Component\SpreadsheetParser\SpreadsheetLoaderInterface');
        $spreadsheet->beADoubleOf('Akeneo\Component\SpreadsheetParser\SpreadsheetInterface');

        $this->addLoader('extension', $loader)->addLoader('other_extension', $otherLoader);
        $loader->open('file.extension')->willReturn($spreadsheet);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\SpreadsheetLoader');
    }

    public function it_uses_the_loader_corresponding_to_the_file_extension($spreadsheet)
    {
        $this->open('file.extension')->shouldReturn($spreadsheet);
    }

    public function it_throws_an_exception_if_no_loader_is_available()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringOpen('file');
    }
}
