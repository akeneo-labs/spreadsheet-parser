<?php

use Akeneo\Component\SpreadsheetParser\Csv\CsvParser;
use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;

/**
 * Functional tests for CSV files
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class CsvTest extends PHPUnit_Framework_TestCase
{
    public function testReadFile()
    {
        $spreadsheet = SpreadsheetParser::open(__DIR__ . '/fixtures/test.csv');
        $this->assertEquals(['default'], $spreadsheet->getWorksheets());
        $this->assertIteratesThrough(
            [
                1 => ['value', 'enclosed value', '15'],
                2 => ['', 'value2', '']
            ],
            $spreadsheet->createRowIterator(0)
        );
    }

    public function testReadFileWithForcedFormat()
    {
        $spreadsheet = SpreadsheetParser::open(__DIR__ . '/fixtures/test.txt', CsvParser::FORMAT_NAME);
        $this->assertEquals(['default'], $spreadsheet->getWorksheets());
        $this->assertIteratesThrough(
            [
                1 => ['value', 'enclosed value', '15'],
                2 => ['', 'value2', '']
            ],
            $spreadsheet->createRowIterator(0)
        );
    }

    public function testCsvParserClass()
    {
        $spreadsheet = CsvParser::open(__DIR__ . '/fixtures/test.txt');
        $this->assertIteratesThrough(
            [
                1 => ['value', 'enclosed value', '15'],
                2 => ['', 'value2', '']
            ],
            $spreadsheet->createRowIterator(0)
        );
    }

    protected function assertIteratesThrough($values, $iterator)
    {
        $valuesIterator = new ArrayIterator($values);
        $valuesIterator->rewind();
        foreach ($iterator as $key => $row) {
            $this->assertTrue($valuesIterator->valid());
            $this->assertEquals($valuesIterator->key(), $key);
            $this->assertEquals($valuesIterator->current(), $row);
            $valuesIterator->next();
        }
        $this->assertFalse($valuesIterator->valid());
    }
}
