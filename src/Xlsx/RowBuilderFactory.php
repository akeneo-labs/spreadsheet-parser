<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Factory for RowBuilder objects
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class RowBuilderFactory
{

    /**
     *
     * @var string
     */
    protected $rowBuilderClass;

    /**
     * Constructor
     *
     * @param string $rowBuilderClass
     */
    public function __construct($rowBuilderClass)
    {
        $this->rowBuilderClass = $rowBuilderClass;
    }

    /**
     * Creates a RowBuilder object
     *
     * @return RowBuilder
     */
    public function create()
    {
        return new $this->rowBuilderClass();
    }
}
