<?php

namespace Akeneo\Component\SpreadsheetParser\Csv;

use Akeneo\Component\SpreadsheetParser\SpreadsheetInterface;

/**
 * Represents a CSV spreadsheet
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Spreadsheet implements SpreadsheetInterface
{
    /**
     * @var RowIteratorFactory
     */
    protected $rowIteratorFactory;

    /**
     * @var string
     */
    protected $sheetName;

    /**
     * @var string
     */
    protected $path;

    /**
     * Constructor
     *
     * @param RowIteratorFactory $rowIteratorFactory
     * @param string             $sheetName
     * @param string             $path
     */
    public function __construct(RowIteratorFactory $rowIteratorFactory, $sheetName, $path)
    {
        $this->rowIteratorFactory = $rowIteratorFactory;
        $this->sheetName = $sheetName;
        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     */
    public function getWorksheets()
    {
        return [$this->sheetName];
    }

    /**
     * {@inheritdoc}
     */
    public function createRowIterator($worksheetIndex, array $options = [])
    {
        return $this->rowIteratorFactory->create($this->path, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getWorksheetIndex($name)
    {
        return $this->sheetName === $name ? 0 : false;
    }
}
