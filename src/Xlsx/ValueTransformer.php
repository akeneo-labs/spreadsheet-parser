<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Transforms cell values according to their type
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ValueTransformer
{
    /**
     * @var DateTransformer
     */
    protected $dateTransformer;

    /**
     * @var SharedStrings
     */
    protected $sharedStrings;

    /**
     * @var Styles
     */
    protected $styles;

    /**
     * @staticvar string Boolean type
     */
    const TYPE_BOOL = 'b';

    /**
     * @staticvar string Number type
     */
    const TYPE_NUMBER = 'n';

    /**
     * @staticvar string Error type
     */
    const TYPE_ERROR = 'e';

    /**
     * @staticvar string Shared string type
     */
    const TYPE_SHARED_STRING = 's';

    /**
     * @staticvar string String type
     */
    const TYPE_STRING = 'str';

    /**
     * @staticvar string Inline string type
     */
    const TYPE_INLINE_STRING = 'inlineStr';

    /**
     * Constructor
     *
     * @param DateTransformer $dateTransformer
     * @param SharedStrings   $sharedStrings
     * @param Styles          $styles
     */
    public function __construct(DateTransformer $dateTransformer, SharedStrings $sharedStrings, Styles $styles)
    {
        $this->dateTransformer = $dateTransformer;
        $this->sharedStrings = $sharedStrings;
        $this->styles = $styles;
    }

    /**
     * Formats a value
     *
     * @param string $value The value which should be transformed
     * @param string $type  The type of the value
     * @param string $style The style of the value
     *
     * @return mixed
     */
    public function transform($value, $type, $style)
    {
        switch ($type) {
            case static::TYPE_BOOL:
                return ('1' === $value);
            case static::TYPE_SHARED_STRING:
                return rtrim($this->sharedStrings->get($value));
            case '':
            case static::TYPE_NUMBER:
                return $style && (Styles::FORMAT_DATE === $this->styles->get($style))
                    ? $this->dateTransformer->transform($value)
                    : $value * 1;
            default:
                return rtrim($value);
        }
    }
}
