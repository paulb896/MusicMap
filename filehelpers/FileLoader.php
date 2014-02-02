<?php

namespace filehelpers;

use filehelpers\File;

/**
 * Loading file data.
 */
class FileLoader
{
    /**
     * Load file from file path, set path, and return given file.
     *
     * @param string $filePath A media files current location.
     * @throws \Exception (indirectly) When file path is non-readable.
     * @return FileInterface Loaded file.
     */
    public function getLoadedFile($filePath)
    {
        $file = new File();
        $file->setPath($filePath);
        return $file;
    }
}