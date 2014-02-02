<?php

class MediaCopyTest
{
    /**
     * Verify file copying functionality.
     */
    public static function testCopyingAFile()
    {
        $fileName = 'song.mp3';
        $copiedFileName = 'song2.mp3';
        $fileLoader = new FileLoader();

        $testFile = $fileLoader->loadFile($fileName);
        $testFile->setPath($fileName); // checks if file exists
        $fileCopier = new FileCopier();
        $fileCopier->copyFileToPath($testFile, $copiedFileName);
        $testFile->setPath($copiedFileName); // checks if copied file exists
        unlink($copiedFileName);
    }
}