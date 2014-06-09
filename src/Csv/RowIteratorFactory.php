<?php

namespace Akeneo\Component\SpreadsheetParser\Csv;

/**
 * Row iterator factory
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class RowIteratorFactory
{
    /**
     * @var string
     */
    protected $iteratorClass;

    /**
     * Constructor
     *
     * @param string $iteratorClass the class for row iterators
     */
    public function __construct($iteratorClass)
    {
        $this->iteratorClass = $iteratorClass;
    }

    /**
     * Creates a row iterator for the XML given worksheet file
     *
     * @param string $path    the path to the extracted XML worksheet file
     * @param array  $options options specific to the format
     *
     * @return RowIterator
     */
    public function create($path, array $options)
    {
        return new $this->iteratorClass($path, $options);
    }

}
