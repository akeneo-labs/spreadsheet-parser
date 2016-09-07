<?php

namespace Akeneo\Component\SpreadsheetParser;

/**
 * Common interface for spreadsheet loaders
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface SpreadsheetLoaderInterface
{
    /**
     * Opens a spreadsheet and returns a Spreadsheet object
     *
     * Spreadsheet objects are cached, and will be read only once
     *
     * @param string      $path
     * @param string|null $type
     *
     * @return SpreadsheetInterface
     */
    public function open($path, $type = null);
}
