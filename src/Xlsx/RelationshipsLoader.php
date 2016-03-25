<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Relationships loader
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class RelationshipsLoader
{
    /**
     *
     * @var string
     */
    protected $relationshipClass;

    /**
     * Constructor
     *
     * @param string $relationshipClass The class of the relationship objects
     */
    public function __construct($relationshipClass)
    {
        $this->relationshipClass = $relationshipClass;
    }

    /**
     * Opens a relationships file
     *
     * @param string $path
     *
     * @return Relationships
     */
    public function open($path)
    {
        return new $this->relationshipClass($path);
    }
}
