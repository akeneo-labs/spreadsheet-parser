<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Spreadsheet relationships
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Relationships extends AbstractXMLResource
{

    /**
     *
     * @var string
     */
    protected $relationshipsPath;

    /**
     *
     * @var array
     */
    protected $workSheetPaths;

    /**
     *
     * @var string
     */
    protected $stylePath;

    /**
     *
     * @var string
     */
    protected $sharedStringPath;

    /**
     * Constructor
     *
     * @param string $path the path to the XML relationships file
     */
    public function __construct($path)
    {
        parent::__construct($path);
        $xml = $this->getXMLReader();

        while ($xml->read()) {
            if (\XMLReader::ELEMENT === $xml->nodeType && 'Relationship' === $xml->name) {

                $type = basename((string)$xml->getAttribute('Type'));
                $this->storeRelationShipByType($type, $xml->getAttribute('Id'), 'xl/' . $xml->getAttribute('Target'));
            }
        }

        $this->closeXMLReader();
    }

    /**
     * Returns the path of a worksheet file inside the xlsx file
     *
     * @param string $id
     *
     * @return string
     */
    public function getWorksheetPath($id)
    {
        return $this->workSheetPaths[$id];
    }

    /**
     * Returns the path of the shared strings file inside the xlsx file
     *
     * @return string
     */
    public function getSharedStringsPath()
    {
        return $this->sharedStringPath;
    }

    /**
     * Returns the path of the styles XML file inside the xlsx file
     *
     * @return string
     */
    public function getStylesPath()
    {
        return $this->stylePath;
    }

    /**
     * stores the relationShip into the right variable
     *
     * @param string $type
     * @param string $id
     * @param string $target
     */
    private function storeRelationShipByType($type, $id, $target)
    {
        switch ($type) {
            case 'worksheet':
                $this->workSheetPaths[$id] = $target;
                break;
            case 'styles':
                $this->stylePath = $target;
                break;
            case 'sharedStrings':
                $this->sharedStringPath = $target;
                break;
        }
    }

}
