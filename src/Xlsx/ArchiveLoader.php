<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * XLSX archive loader
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ArchiveLoader
{
    /**
     *
     * @var string
     */
    protected $archiveClass;

    /**
     * Constructor
     *
     * @param string $archiveClass The class of loaded objects
     */
    public function __construct($archiveClass)
    {
        $this->archiveClass = $archiveClass;
    }

    /**
     * Opens the given archive
     *
     * @param string $path
     *
     * @return Archive
     */
    public function open($path)
    {
        return new $this->archiveClass($path);
    }
}
