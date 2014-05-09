<?php

namespace Akeneo\Component\SpreadsheetParser;

/**
 * Common interface for workbook loaders
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface WorkbookLoaderInterface
{
    /**
     * Opens a workbook and returns a Workbook object
     *
     * Workbook objects are cached, and will be read only once
     *
     * @param string $path
     *
     * @return Workbook
     */
    public function open($path);
}
