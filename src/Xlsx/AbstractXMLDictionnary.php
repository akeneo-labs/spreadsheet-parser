<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Base class for XML dictionnary resources
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
abstract class AbstractXMLDictionnary extends AbstractXMLResource
{
    /**
     * @var boolean
     */
    protected $valid = true;

    /**
     * @var array
     */
    protected $values = [];

    /**
     * Returns a shared string by index
     *
     * @param int $index
     *
     * @throws \InvalidArgumentException
     */
    public function get($index)
    {
        while ($this->valid && !isset($this->values[$index])) {
            $this->readNext();
        }
        if ((!isset($this->values[$index]))) {
            throw new \InvalidArgumentException(sprintf('No value with index %s', $index));
        }

        return $this->values[$index];
    }

    /**
     * Reads the next value in the file
     */
    abstract protected function readNext();
}
