<?php

namespace Akeneo\Component\SpreadsheetParser\Csv;

/**
 * Entry point for CSV parser
 *
 * @author Antoine Guigan <aguigan@qimnet.com>
 */
class CsvParser
{
    /**
     * @staticvar string Spreadsheet class
     */
    const WORKBOOK_CLASS = 'Akeneo\Component\SpreadsheetParser\Csv\Spreadsheet';

    /**
     * @staticvar string RowIterator class
     */
    const ROW_ITERATOR_CLASS = 'Akeneo\Component\SpreadsheetParser\Csv\RowIterator';

    /**
     * @var SpreadsheetLoader
     */
    private static $workbookLoader;

    /**
     * Opens a CSV file
     *
     * @param string $path
     *
     * @return Spreadsheet
     */
    public static function open($path)
    {
        return static::getSpreadsheetLoader()->open($path);
    }

    /**
     * @return SpreadsheetLoader
     */
    public static function getSpreadsheetLoader()
    {
        if (!isset(self::$workbookLoader)) {
            self::$workbookLoader = new SpreadsheetLoader(
                static::createRowIteratorFactory(),
                static::WORKBOOK_CLASS
            );
        }

        return self::$workbookLoader;
    }

    /**
     * @return RowIteratorFactory
     */
    protected static function createRowIteratorFactory()
    {
        return new RowIteratorFactory(static::ROW_ITERATOR_CLASS);
    }
}
