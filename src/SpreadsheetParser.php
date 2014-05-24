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
     * @return WorkbookInterface
     */
    public static function open($path)
    {
        return static::getXlsxWorkbookLoader()->open($path);
    }

    /**
     * Returns the XLSX workbook loader
     *
     * @return WorkbookLoaderInterface
     */
    public static function getXlsxWorkbookLoader()
    {
        return Xlsx\XlsxParser::getWorkbookLoader();
    }
}
