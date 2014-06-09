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
            if (true !== $this->zip->open($this->archivePath)) {
                $this->zip = null;
                throw new \RuntimeException('Error opening file');
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
}
