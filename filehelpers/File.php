<?php

namespace filehelpers;

use filehelpers\FileInterface;

class File implements FileInterface
{
    /**
     * Metadata keyed by type.
     * @type array
     */
    public $metadata = [];

    /**
     * Load file, and clear metadata.
     *
     * @param string $filePath Path to file
     * @throws \Exception
     */
    public function setPath($filePath)
    {
        if (file_exists($filePath)) {
            $this->path = $filePath;
            $this->metadata = [];
        } else {
            throw new \Exception('File does not exist ' . $filePath);
        }
    }

    /**
     * Get the files current path if it is set.
     *
     * @throws \Exception When no path exists for a file.
     * @return string Current file path.
     */
    public function getPath()
    {
        if (!$this->path) {
            throw new \Exception('File has no path');
        }

        return $this->path;
    }

    /**
     * Path to file.
     *
     * @type string
     */
    protected $path;
}