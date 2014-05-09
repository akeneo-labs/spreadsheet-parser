<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Represents an XLSX Archive
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
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
        $zip = new \ZipArchive();
        $tempPath = sprintf('%s/%s', $this->tempPath, $filePath);

        if (!file_exists($tempPath) && true === $zip->open($this->archivePath)) {

            $zip->extractTo($this->tempPath, $filePath);
            $zip->close();
        } else {

            throw new \Exception('Error opening file');
        }

        return $tempPath;
    }

    /**
     * Clears all extracted files
     */
    public function __destruct()
    {
        $this->deleteTemp();
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
