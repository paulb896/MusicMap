<?php

use filehelpers\Metadata;

class MetadataLoaderTest
{
    /**
     * Verify metadata loading functionality.
     */
    public static function testLoadMetadata()
    {
        $fileName = 'song.mp3';

        $fileLoader = new FileLoader();

        $testFile = $fileLoader->loadFile($fileName);
        $loader = new MetadataLoader();
        $loader->loadMetadata($testFile);
        //print_r($testFile->metadata);
    }
}