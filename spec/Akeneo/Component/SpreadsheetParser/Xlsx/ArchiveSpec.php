<?php

namespace spec\Akeneo\Component\SpreadsheetParser\Xlsx;

use PhpSpec\ObjectBehavior;

class ArchiveSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(__DIR__ . '/fixtures/test.zip');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\Component\SpreadsheetParser\Xlsx\Archive');
    }

    public function it_extracts_files()
    {
        $this->extract('file1')->shouldHaveFileContent("file1\n");
    }

    public function it_extracts_files_from_subfolders()
    {
        $this->extract('folder/file2')->shouldHaveFileContent("file2\n");
    }

    public function it_extracts_files_once()
    {
        $file = $this->extract('file1');
        $file->shouldHaveFileContent("file1\n");
        file_put_contents($file->getWrappedObject(), 'content');
        $this->extract('file1')->shouldHaveFileContent('content');
    }

    public function getMatchers()
    {
        return [
            'haveFileContent' => function ($filepath, $content) {
                return $content === file_get_contents($filepath);
            }
        ];
    }
}
