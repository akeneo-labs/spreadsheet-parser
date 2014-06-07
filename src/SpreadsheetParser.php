<?php

namespace Akeneo\Component\SpreadsheetParser;

/**
 * Entry point for the SpreadsheetParser component
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SpreadsheetParser
{
    /**
     * @var SpreadsheetLoader
     */
    protected static $spreadsheetLoader;

    /**
     * Opens a workbook
     *
     * @param string $path
     *
     * @return SpreadsheetInterface
     */
    public static function open($path)
    {
        return static::getSpreadsheetLoader()->open($path);
    }

    /**
     * Returns the workbook loader
     *
     * @return SpreadsheetLoaderInterface
     */
    public static function getSpreadsheetLoader()
    {
        if (!isset(static::$spreadsheetLoader)) {
            static::$spreadsheetLoader = new SpreadsheetLoader();
            static::configureLoaders();
        }

        return static::$spreadsheetLoader;
    }

    protected static function configureLoaders()
    {
        static::$spreadsheetLoader
            ->addLoader('xlsx', Xlsx\XlsxParser::getSpreadsheetLoader())
            ->addLoader('csv', Csv\CsvParser::getSpreadsheetLoader());
    }
}
