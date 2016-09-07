<?php

namespace Akeneo\Component\SpreadsheetParser;

use InvalidArgumentException;

/**
 * Format agnostic spreadsheet loader
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SpreadsheetLoader implements SpreadsheetLoaderInterface
{
    /**
     * @var SpreadsheetLoaderInterface[]
     */
    protected $loaders = [];

    /**
     * Opens a spreadsheet
     *
     * @param string      $path
     * @param string|null $type
     *
     * @return SpreadsheetInterface
     *
     * @throws InvalidArgumentException
     */
    public function open($path, $type = null)
    {
        $type = $type ?: $this->getType($path);
        if (!isset($this->loaders[$type])) {
            throw new InvalidArgumentException(sprintf('No loader for type %s', $type));
        }

        return $this->loaders[$type]->open($path);
    }

    /**
     * Addds a loader for a specified type
     *
     * @param string                     $type
     * @param SpreadsheetLoaderInterface $loader
     *
     * @return SpreadsheetLoader
     */
    public function addLoader($type, SpreadsheetLoaderInterface $loader)
    {
        $this->loaders[$type] = $loader;

        return $this;
    }

    /**
     * Returns the type for a path
     *
     * @param string $path
     *
     * @return string
     */
    protected function getType($path)
    {
        return strtolower(pathinfo($path, PATHINFO_EXTENSION));
    }
}
