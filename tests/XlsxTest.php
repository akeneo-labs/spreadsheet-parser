<?php

use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;

/**
 * Functional tests for XLSX files
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class XlsxTest extends PHPUnit_Framework_TestCase
{
    public function testLibreOfficeFile()
    {
        $workbook = SpreadsheetParser::open(__DIR__ . '/fixtures/libreoffice.xlsx');
        $this->assertEquals(['Sheet1', 'Sheet2'], $workbook->getWorksheets());
        $this->assertIteratesThrough(
            [
                2 => ['value1', '', 'value2'],
                3 => ['value3', '2010-12-05 00:00', 154],
                5 => ['test', '2006-08-12 15:46']
            ],
            $workbook->createRowIterator(0)
        );
        $this->assertIteratesThrough(
            [
                4 => ['value7', '', 'value11']
            ],
            $workbook->createRowIterator(1)
        );
    }

    public function testReadSameFileTwice()
    {
        $workbook = SpreadsheetParser::open(__DIR__ . '/fixtures/libreoffice.xlsx');
        $this->assertEquals(['Sheet1', 'Sheet2'], $workbook->getWorksheets());
        $this->assertIteratesThrough(
            [
                2 => ['value1', '', 'value2'],
                3 => ['value3', '2010-12-05 00:00', 154],
                5 => ['test', '2006-08-12 15:46']
            ],
            $workbook->createRowIterator(0)
        );
        $this->assertIteratesThrough(
            [
                2 => ['value1', '', 'value2'],
                3 => ['value3', '2010-12-05 00:00', 154],
                5 => ['test', '2006-08-12 15:46']
            ],
            $workbook->createRowIterator(0)
        );
    }

    public function testMsOfficeFile()
    {
        $workbook = SpreadsheetParser::open(__DIR__ . '/fixtures/msoffice.xlsx');
        $this->assertEquals(['Feuil1', 'Feuil2', 'Feuil3'], $workbook->getWorksheets());
        $this->assertIteratesThrough(
            [
                3 => ['value1', '', '2014-12-15 00:00', '2015-01-15 12:16'],
                5 => ['', 'value5']
            ],
            $workbook->createRowIterator(0)
        );
        $this->assertIteratesThrough(
            [
                6 => ['', 'test1'],
            ],
            $workbook->createRowIterator(1)
        );
        $this->assertIteratesThrough(
            [
                1 => ['', '', '', 'test4'],
            ],
            $workbook->createRowIterator(2)
        );
    }

    protected function assertIteratesThrough($values, $iterator)
    {
        $valuesIterator = new ArrayIterator($values);
        $valuesIterator->rewind();
        foreach ($iterator as $key => $row) {
            foreach ($row as &$value) {
                if ($value instanceof DateTime) {
                    $value = $value->format('Y-m-d H:i');
                }
            }
            $this->assertTrue($valuesIterator->valid());
            $this->assertEquals($valuesIterator->key(), $key);
            $this->assertEquals($valuesIterator->current(), $row);
            $valuesIterator->next();
        }
        $this->assertFalse($valuesIterator->valid());
    }
}
