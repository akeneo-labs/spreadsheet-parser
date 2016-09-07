<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Contains the shared strings of an Excel spreadsheet
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SharedStrings extends AbstractXMLDictionnary
{
    /**
     * @var int
     */
    protected $currentIndex = -1;

    /**
     * Reads the next value in the file
     */
    protected function readNext()
    {
        $xml = $this->getXMLReader();
        while ($xml->read()) {
            if (\XMLReader::ELEMENT === $xml->nodeType) {
                switch ($xml->name) {
                    case 'si':
                        $this->currentIndex++;
                        break;
                    case 't':
                        $this->values[$this->currentIndex] = $xml->readString();

                        return;
                }
            }
        }

        $this->valid = false;
        $this->closeXMLReader();
    }
}
