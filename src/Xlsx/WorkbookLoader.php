<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * XLSX file reader
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class WorkbookLoader
{
    /**
     * @var string
     */
    protected $workbookClass;

    /**
     * @var RelationshipsLoader
     */
    protected $relationshipsLoader;

    /**
     * @var SharedStringsLoader
     */
    protected $sharedStringsLoader;

    /**
     * @var StyleLoader
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
     * @param string                  $workbookClass
     */
    public function __construct(
            ArchiveLoader $archiveLoader,
            RelationshipsLoader $relationshipsLoader,
            SharedStringsLoader $sharedStringsLoader,
            StylesLoader $stylesLoader,
            WorksheetListReader $worksheetListReader,
            ValueTransformerFactory $valueTransformerFactory,
            RowIteratorFactory $rowIteratorFactory,
            $workbookClass
    )
    {
        $this->relationshipsLoader = $relationshipsLoader;
        $this->sharedStringsLoader = $sharedStringsLoader;
        $this->stylesLoader = $stylesLoader;
        $this->worksheetListReader = $worksheetListReader;
        $this->valueTransformerFactory = $valueTransformerFactory;
        $this->rowIteratorFactory = $rowIteratorFactory;
        $this->archiveLoader = $archiveLoader;
        $this->workbookClass = $workbookClass;
    }

    /**
     * Opens an xlsx workbook and returns a Workbook object
     *
     * Workbook objects are cached, and will be read only once
     *
     * @param string $path
     *
     * @return Workbook
     */
    public function open($path)
    {
        $archive = $this->archiveLoader->open($path);

        return new $this->workbookClass(
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
