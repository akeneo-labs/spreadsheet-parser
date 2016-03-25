<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Transforms Excel dates in DateTime objects
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DateTransformer
{
    /**
     * @var \DateTime
     */
    protected $baseDate;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->baseDate = new \DateTime('1900-01-00 00:00:00 UTC');
    }

    /**
     * Transforms an Excel date into a DateTime object
     *
     * @param String $value
     *
     * @return \DateTime
     */
    public function transform($value)
    {
        $days = floor($value);

        $seconds = round(($value - $days) * 86400);

        $date = clone $this->baseDate;
        $date->modify(sprintf('+%sday +%ssecond', $days - 1, $seconds));

        return $date;
    }
}
