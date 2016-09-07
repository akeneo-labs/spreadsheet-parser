<?php

namespace Akeneo\Component\SpreadsheetParser;

/**
 * Common interface for spreadsheets
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface SpreadsheetInterface
{
    /**
     * Returns an array containing all worksheet names
     *
     * The keys of the array should be the indexes of the worksheets
     *
     * @return string[]
     */
    public function getWorksheets();

    /**
     * Returns a row iterator for the current worksheet index
     *
     * @param int   $worksheetIndex
     * @param array $options
     *
     * @return \Iterator
     */
    public function createRowIterator($worksheetIndex, array $options = []);

    /**
     * Returns a worksheet index by name
     *
     * @param string $name
     *
     * @return int|false Returns false in case there is no worksheet with this name
     */
    public function getWorksheetIndex($name);
}
