<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Base class for single files XML resources
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
abstract class AbstractXMLResource
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var \XMLReader
     */
    private $xml;

    /**
     * Constructor
     *
     * @param string $path path to the extracted shared strings XML file
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
    public function __destruct()
    {
        if ($this->xml) {
            $this->closeXMLReader();
        }
    }

    /**
     * Returns the XML reader
     *
     * @return \XMLReader
     */
    protected function getXMLReader()
    {
        if (!$this->xml) {
            $this->xml = $this->createXMLReader();
        }

        return $this->xml;
    }

    /**
     * Creates the XML Reader
     *
     * @return \XMLReader
     */
    protected function createXMLReader()
    {
        $xml = new \XMLReader();
        $xml->open($this->path);

        return $xml;
    }

    /**
     * Closes the XML reader
     */
    protected function closeXMLReader()
    {
        $this->xml->close();
        $this->xml = null;
    }

}
