<?php

namespace Akeneo\Component\SpreadsheetParser\Csv;

use Akeneo\Component\SpreadsheetParser\SpreadsheetLoaderInterface;

/**
 * CSV file reader
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SpreadsheetLoader implements SpreadsheetLoaderInterface
{
    /**
     * @var RowIteratorFactory
     */
    protected $rowIteratorFactory;

    /**
     * @var string
     */
    protected $workbookClass;

    /**
     *
     * @var string
     */
    protected $sheetName;

    /**
     * Constructor
     *
     * @param RowIteratorFactory $rowIteratorFactory
     * @param string             $workbookClass
     * @param string             $sheetName
     */
    public function __construct(RowIteratorFactory $rowIteratorFactory, $workbookClass, $sheetName)
    {
        $this->rowIteratorFactory = $rowIteratorFactory;
        $this->workbookClass = $workbookClass;
        $this->sheetName = $sheetName;
    }

    /**
     * {@inheritdoc}
     */
    public function open($path)
    {
        return new $this->workbookClass(
            $this->rowIteratorFactory,
            $this->sheetName,
            $path
        );
    }

}
