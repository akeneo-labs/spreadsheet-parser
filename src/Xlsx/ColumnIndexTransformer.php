<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Transforms an Excel cell name in an index
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class ColumnIndexTransformer
{
    /**
     * Transforms an Excel cell name in an index
     *
     * @param string $name
     *
     * @return integer
     */
    public function transform($name)
    {
        $number = -1;

        foreach (str_split($name) as $chr) {
            $digit = ord($chr) - 65;
            if ($digit < 0) {
                break;
            }
            $number = ($number + 1) * 26 + $digit;
        }

        return $number;
    }
}
