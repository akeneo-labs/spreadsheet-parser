<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * SharedStrings factory
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SharedStringsLoader
{

    /**
     *
     * @var string
     */
    protected $sharedStringsClass;

    /**
     * Constructor
     *
     * @param string $sharedStringsClass The class for created objects
     */
    public function __construct($sharedStringsClass)
    {
        $this->sharedStringsClass = $sharedStringsClass;
    }

    /**
     * Creates a SharedStrings from the archive
     *
     * @param string  $path
     * @param Archive $archive The Archive from which the path was extracted
     *
     * @return SharedStrings
     */
    public function open($path, Archive $archive)
    {
        return new $this->sharedStringsClass($path, $archive);
    }

}
