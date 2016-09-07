<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Spreadsheet styles
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Styles extends AbstractXMLDictionnary
{
    /**
     * @staticvar int Default format
     */
    const FORMAT_DEFAULT = 0;

    /**
     * @staticvar int Date format
     */
    const FORMAT_DATE = 1;

    /**
     * @var array
     */
    protected $nativeDateFormats = [14, 15, 16, 17, 18, 19, 20, 21, 22];

    /**
     * @var array
     */
    protected $numberFormats = [];

    /**
     * @var boolean
     */
    protected $inXfs;

    /**
     * {@inheritdoc}
     */
    protected function readNext()
    {
        $xml = $this->getXMLReader();
        while ($xml->read()) {
            if (\XMLReader::END_ELEMENT === $xml->nodeType && 'cellXfs' === $xml->name) {
                break;
            } elseif (\XMLReader::ELEMENT === $xml->nodeType && 'cellXfs' === $xml->name) {
                $this->inXfs = true;
            } elseif ($this->inXfs && \XMLReader::ELEMENT === $xml->nodeType && 'xf' === $xml->name) {
                $fmtId = $xml->getAttribute('numFmtId');
                if (isset($this->numberFormats[$fmtId])) {
                    $value = $this->numberFormats[$fmtId];
                } elseif (in_array($fmtId, $this->nativeDateFormats)) {
                    $value = static::FORMAT_DATE;
                } else {
                    $value = static::FORMAT_DEFAULT;
                }
                $this->values[] = $value;

                return;
            }
        }
        $this->valid = false;
        $this->closeXMLReader();
    }

    /**
     * {@inheritdoc}
     */
    protected function createXMLReader()
    {
        $xml = parent::createXMLReader();
        $needsRewind = false;
        while ($xml->read()) {
            if (\XMLReader::END_ELEMENT === $xml->nodeType && 'numFmts' === $xml->name) {
                break;
            } elseif (\XMLReader::ELEMENT === $xml->nodeType) {
                switch ($xml->name) {
                    case 'numFmt':
                        $this->numberFormats[$xml->getAttribute('numFmtId')] =
                            preg_match('{^(\[\$[[:alpha:]]*-[0-9A-F]*\])*[hmsdy]}i', $xml->getAttribute('formatCode'))
                                ? static::FORMAT_DATE
                                : static::FORMAT_DEFAULT;
                        break;
                    case 'cellXfs':
                        $needsRewind = true;
                        break;
                }
            }
        }
        if ($needsRewind) {
            $xml->close();
            $xml = parent::createXMLReader();
        }

        return $xml;
    }
}
