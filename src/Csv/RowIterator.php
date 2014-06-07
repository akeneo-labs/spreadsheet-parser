<?php

namespace Akeneo\Component\SpreadsheetParser\Csv;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Row iterator for an Excel worksheet
 *
 * The iterator returns arrays of results.
 *
 * Empty values are trimed from the right of the rows, and empty rows are skipped.
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class RowIterator implements \Iterator
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var int
     */
    protected $fileHandle;

    /**
     * @var array
     */
    protected $currentKey;

    /**
     * @var array
     */
    protected $currentValue;

    /**
     * @var boolean
     */
    protected $valid;

    /**
     * Constructor
     *
     * @param string $path
     * @param array  $options
     */
    public function __construct(
        $path,
        array $options
    ) {
        $this->path = $path;
        $resolver = new OptionsResolver;
        $this->setDefaultOptions($resolver);
        $this->options = $resolver->resolve($options);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->currentValue;
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->currentKey;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->currentValue = fgetcsv(
            $this->fileHandle,
            $this->options['length'],
            $this->options['delimiter'],
            $this->options['enclosure'],
            $this->options['escape']
        );
        $this->currentKey++;
        $this->valid = (false !== $this->currentValue);
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        if ($this->fileHandle) {
            rewind($this->fileHandle);
        } else {
            $this->fileHandle = fopen($this->path, 'r');
        }
        $this->currentKey = -1;
        $this->next();
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->valid;
    }

    /**
     * Sets the default options
     *
     * @param OptionsResolverInterface $resolver
     */
    protected function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'length'    => null,
                'delimiter' => ',',
                'enclosure' => '"',
                'escape'    => '\\'
            ]
        );
    }
}
