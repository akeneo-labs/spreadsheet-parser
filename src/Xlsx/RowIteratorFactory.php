<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

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
     *
     * @var RowBuilderFactory
     */
    protected $rowBuilderFactory;

    /**
     *
     * @var ColumnIndexTransformer
     */
    protected $columnIndexTransformer;

    /**
     *
     * @var string
     */
    protected $iteratorClass;

    /**
     * Constructor
     *
     * @param RowBuilderFactory      $rowBuilderFactory
     * @param ColumnIndexTransformer $columnIndexTransformer
     * @param string                 $iteratorClass          the class for row iterators
     */
    public function __construct(
        RowBuilderFactory $rowBuilderFactory,
        ColumnIndexTransformer $columnIndexTransformer,
        $iteratorClass
    ) {
        $this->rowBuilderFactory = $rowBuilderFactory;
        $this->columnIndexTransformer = $columnIndexTransformer;
        $this->iteratorClass = $iteratorClass;
    }

    /**
     * Creates a row iterator for the XML given worksheet file
     *
     * @param ValueTransformer $valueTransformer the value transformer for the spreadsheet
     * @param string           $path             the path to the extracted XML worksheet file
     * @param array            $options          options specific to the format
     * @param Archive          $archive          The Archive from which the path was extracted
     *
     * @return RowIterator
     */
    public function create(ValueTransformer $valueTransformer, $path, array $options, Archive $archive)
    {
        return new $this->iteratorClass(
            $this->rowBuilderFactory,
            $this->columnIndexTransformer,
            $valueTransformer,
            $path,
            $options,
            $archive
        );
    }

}
