<?php

namespace Akeneo\Component\SpreadsheetParser;

/**
 * Entry point for the SpreadsheetParser component
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SpreadsheetParser
{
    /**
     * @var SpreadsheetLoader
     */
    protected static $spreadsheetLoader;

    /**
     * Opens a spreadsheet
     *
     * @param string      $path
     * @param string|null $type
     *
     * @return SpreadsheetInterface
     */
    public static function open($path, $type = null)
    {
        return static::getSpreadsheetLoader()->open($path, $type);
    }

    /**
     * Returns the spreadsheet loader
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

    /**
     * Configure the loaders
     */
    protected static function configureLoaders()
    {
        static::$spreadsheetLoader
            ->addLoader(Xlsx\XlsxParser::FORMAT_NAME, Xlsx\XlsxParser::getSpreadsheetLoader())
            ->addLoader(Xlsx\XlsxParser::MACRO_FORMAT_NAME, Xlsx\XlsxParser::getSpreadsheetLoader())
            ->addLoader(Csv\CsvParser::FORMAT_NAME, Csv\CsvParser::getSpreadsheetLoader());
    }
}
