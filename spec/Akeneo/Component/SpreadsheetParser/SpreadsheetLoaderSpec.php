<?php

namespace spec\Akeneo\Component\SpreadsheetParser;

use Akeneo\Component\SpreadsheetParser\SpreadsheetInterface;
use Akeneo\Component\SpreadsheetParser\SpreadsheetLoaderInterface;
use PhpSpec\ObjectBehavior;

class SpreadsheetLoaderSpec extends ObjectBehavior
{
    public function let(
        SpreadsheetLoaderInterface $loader,
        SpreadsheetLoaderInterface $otherLoader,
        SpreadsheetInterface $spreadsheet
    ) {
        $this->addLoader('extension', $loader);
        $loader->open('file.extension')->willReturn($spreadsheet);
        $this->addLoader('other_extension', $otherLoader);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\SpreadsheetLoader');
    }

    public function it_uses_the_loader_corresponding_to_the_file_extension(
        SpreadsheetInterface $spreadsheet
    ) {
        $this->open('file.extension')->shouldReturn($spreadsheet);
    }
}
