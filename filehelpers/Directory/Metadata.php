<?php

namespace filehelpers\File;

use filehelpers\FileInterface;

/**
 * Loading metadata for file.
 */
class Metadata
{
    /**
     * @type string
     */
    public $pathToMediaInfo = 'MediaInfo.exe';

    /**
     * Attempt to extract metadata from file, and add
     * data to file object.
     *
     * @param FileInterface $file A file.
     * @return FileInterface $file File with metadata added.
     */
    public function loadMetadata(FileInterface $file)
    {

        // // var_dump($command);
        // // return;

        // var_dump($rawMetadata);
        $file->metadata = $this->getMetadataUsingScript($file);
        return $file;
    }

    /**
     * @param FileInterface $file
     * @return array
     */
    protected function getMetadataUsingScript(FileInterface $file)
    {
        $metadata = [];
        $command = "$this->pathToMediaInfo " . $file->getPath();
        exec($command, $dataLines);
        foreach ($dataLines as $line) {
            $keyAndData = explode(":", $line);
            $metadata[trim($keyAndData[0])] = trim($keyAndData[1]);
        }

        return $metadata;
    }
}