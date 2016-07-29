<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Represents an XLSX Archive
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Archive
{
    /**
     *
     * @var string
     */
    protected $tempPath;

    /**
     *
     * @var string
     */
    protected $archivePath;

    /**
     * @var \ZipArchive
     */
    private $zip;

    /**
     * Constructor
     *
     * @param string $archivePath
     */
    public function __construct($archivePath)
    {
        $this->archivePath = $archivePath;
        $this->tempPath = tempnam(sys_get_temp_dir(), 'xls_parser_archive');
        unlink($this->tempPath);
    }

    /**
     * Extracts the specified file to a temp path, and return the temp path
     *
     * Files are only extracted once for the given archive
     *
     * @param string $filePath
     *
     * @return string
     */
    public function extract($filePath)
    {
        $tempPath = sprintf('%s/%s', $this->tempPath, $filePath);
        if (!file_exists($tempPath)) {
            $this->getArchive()->extractTo($this->tempPath, $filePath);
        }

        return $tempPath;
    }

    /**
     * Clears all extracted files
     */
    public function __destruct()
    {
        $this->deleteTemp();
        $this->closeArchive();
    }

    /**
     * Returns the archive
     *
     * @return \ZipArchive
     */
    protected function getArchive()
    {
        if (!$this->zip) {
            $this->zip = new \ZipArchive();
            if (true !== $errorCode = $this->zip->open($this->archivePath)) {
                $this->zip = null;
                throw new \RuntimeException('Error opening file: '.$this->getErrorMessage($errorCode));
            }
        }

        return $this->zip;
    }

    /**
     * Closes the archive
     */
    protected function closeArchive()
    {
        if ($this->zip) {
            $this->zip->close();
            $this->zip = null;
        }
    }

    /**
     * Deletes temporary files
     *
     * @return null
     */
    protected function deleteTemp()
    {
        if (!file_exists($this->tempPath)) {
            return;
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->tempPath, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($this->tempPath);
    }

    /**
     * Gets an error message from the error code
     *
     * @param string $errorCode
     *
     * @return string
     */
    protected function getErrorMessage($errorCode)
    {
        switch ($errorCode) {
            case \ZipArchive::ER_MULTIDISK:
                return 'Multi-disk zip archives not supported';

            case \ZipArchive::ER_RENAME:
                return 'Renaming temporary file failed';

            case \ZipArchive::ER_CLOSE:
                return 'Closing zip archive failed';

            case \ZipArchive::ER_SEEK:
                return 'Seek error';

            case \ZipArchive::ER_READ:
                return 'Read error';

            case \ZipArchive::ER_WRITE:
                return 'Write error';

            case \ZipArchive::ER_CRC:
                return 'CRC error';

            case \ZipArchive::ER_ZIPCLOSED:
                return 'Containing zip archive was closed';

            case \ZipArchive::ER_NOENT:
                return 'No such file';

            case \ZipArchive::ER_EXISTS:
                return 'File already exists';

            case \ZipArchive::ER_OPEN:
                return 'Can\'t open file';

            case \ZipArchive::ER_TMPOPEN:
                return 'Failure to create temporary file';

            case \ZipArchive::ER_ZLIB:
                return 'Zlib error';

            case \ZipArchive::ER_MEMORY:
                return 'Malloc failure';

            case \ZipArchive::ER_CHANGED:
                return 'Entry has been changed';

            case \ZipArchive::ER_COMPNOTSUPP:
                return 'Compression method not supported';

            case \ZipArchive::ER_EOF:
                return 'Premature EOF';

            case \ZipArchive::ER_INVAL:
                return 'Invalid argument';

            case \ZipArchive::ER_NOZIP:
                return 'Not a zip archive';

            case \ZipArchive::ER_INTERNAL:
                return 'Internal error';

            case \ZipArchive::ER_INCONS:
                return 'Zip archive inconsistent';

            case \ZipArchive::ER_REMOVE:
                return 'Can\'t remove file';

            case \ZipArchive::ER_DELETED:
                return 'Entry has been deleted';

            default:
                return 'An unknown error has occurred('.intval($errorCode).')';
        }
    }
}
