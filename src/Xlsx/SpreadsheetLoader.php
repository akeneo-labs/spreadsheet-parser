<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

use Akeneo\Component\SpreadsheetParser\SpreadsheetLoaderInterface;

/**
 * XLSX file reader
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SpreadsheetLoader implements SpreadsheetLoaderInterface
{
    /**
     * @var string
     */
    protected $spreadsheetClass;

    /**
     * @var RelationshipsLoader
     */
    protected $relationshipsLoader;

    /**
     * @var SharedStringsLoader
     */
    protected $sharedStringsLoader;

    /**
     * @var StylesLoader
     */
    protected $stylesLoader;

    /**
     * @var WorksheetListReader
     */
    protected $worksheetListReader;

    /**
     * @var ValueTransformerFactory
     */
    protected $valueTransformerFactory;

    /**
     * @var RowIteratorFactory
     */
    protected $rowIteratorFactory;

    /**
     * @var ArchiveLoader
     */
    protected $archiveLoader;

    /**
     * Constructor
     *
     * @param ArchiveLoader           $archiveLoader
     * @param RelationshipsLoader     $relationshipsLoader
     * @param SharedStringsLoader     $sharedStringsLoader
     * @param StylesLoader            $stylesLoader
     * @param WorksheetListReader     $worksheetListReader
     * @param ValueTransformerFactory $valueTransformerFactory
     * @param RowIteratorFactory      $rowIteratorFactory
     * @param string                  $spreadsheetClass
     */
    public function __construct(
        ArchiveLoader $archiveLoader,
        RelationshipsLoader $relationshipsLoader,
        SharedStringsLoader $sharedStringsLoader,
        StylesLoader $stylesLoader,
        WorksheetListReader $worksheetListReader,
        ValueTransformerFactory $valueTransformerFactory,
        RowIteratorFactory $rowIteratorFactory,
        $spreadsheetClass
    ) {
        $this->relationshipsLoader = $relationshipsLoader;
        $this->sharedStringsLoader = $sharedStringsLoader;
        $this->stylesLoader = $stylesLoader;
        $this->worksheetListReader = $worksheetListReader;
        $this->valueTransformerFactory = $valueTransformerFactory;
        $this->rowIteratorFactory = $rowIteratorFactory;
        $this->archiveLoader = $archiveLoader;
        $this->spreadsheetClass = $spreadsheetClass;
    }

    /**
     * {@inheritdoc}
     */
    public function open($path, $type = null)
    {
        $archive = $this->archiveLoader->open($path);

        return new $this->spreadsheetClass(
            $archive,
            $this->relationshipsLoader,
            $this->sharedStringsLoader,
            $this->stylesLoader,
            $this->worksheetListReader,
            $this->valueTransformerFactory,
            $this->rowIteratorFactory
        );
    }

}
