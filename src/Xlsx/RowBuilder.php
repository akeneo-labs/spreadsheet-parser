<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Builds a row with skipped values
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class RowBuilder
{

    /**
     *
     * @var array
     */
    protected $values = [];

    /**
     * Adds a value to the row
     *
     * @param int    $columnIndex
     * @param string $value
     */
    public function addValue($columnIndex, $value)
    {
        if ('' !== $value) {
            $this->values[$columnIndex] = $value;
        }
    }

    /**
     * Returns the read row
     *
     * @return array
     */
    public function getData()
    {
        $data = [];
        foreach ($this->values as $columnIndex => $value) {
            while (count($data) < $columnIndex) {
                $data[] = '';
            }
            $data[] = $value;
        }

        return $data;
    }
}
