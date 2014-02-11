<?php

namespace filehelpers\File;

use \filehelpers\File\Model;

/**
 * Loading file data.
 */
class ModelFactory
{
    /**
     * Load file from file path, set path, and return given file.
     *
     * @param string $filePath A media files current location.
     * @throws \Exception (indirectly) When file path is non-readable.
     * @return FileInterface Loaded file.
     */
    public function getFile($filePath)
    {
        $file = new Model();
        $file->setPath($filePath);
        return $file;
    }
}