<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Creates ValueTransformer objects
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ValueTransformerFactory
{
    /**
     *
     * @var string
     */
    protected $transformerClass;

    /**
     *
     * @var DateTransformer
     */
    protected $dateTransformer;

    /**
     * Constructor
     *
     * @param DateTransformer $dateTransformer
     * @param string          $transformerClass The class of the created objects
     */
    public function __construct(DateTransformer $dateTransformer, $transformerClass)
    {
        $this->dateTransformer = $dateTransformer;
        $this->transformerClass = $transformerClass;
    }

    /**
     * Creates a value transformer
     *
     * @param SharedStrings $sharedStrings
     * @param Styles        $styles
     * 
     * @return ValueTransformer
     */
    public function create(SharedStrings $sharedStrings, Styles $styles)
    {
        return new $this->transformerClass($this->dateTransformer, $sharedStrings, $styles);
    }
}
