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
     * Opens a workbook
     *
     * @param string $path
     *
     * @return SpreadsheetInterface
     */
    public static function open($path)
    {
        return static::getXlsxSpreadsheetLoader()->open($path);
    }

    /**
     * Returns the XLSX workbook loader
     *
     * @return Xlsx\SpreadsheetLoader
     */
    public static function getXlsxSpreadsheetLoader()
    {
        return Xlsx\XlsxParser::getSpreadsheetLoader();
    }
}
