<?php

namespace Akeneo\Component\SpreadsheetParser;

/**
 * Common interface for workbook loaders
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface SpreadsheetLoaderInterface
{
    /**
     * Opens a workbook and returns a Spreadsheet object
     *
     * Spreadsheet objects are cached, and will be read only once
     *
     * @param string $path
     *
     * @return Spreadsheet
     */
    public function open($path);
}
