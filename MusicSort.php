<?php

namespace MusicSort;

require_once 'autoload.php';

echo "Usage: php MusicSort.php <inputDirectory> <outputDirectory> <groupByType> [pathToMediaInfo]" . PHP_EOL;
echo "Example: php MusicSort.php C:\Users\Paul\Music C:\Users\Paul\OrganizedMusic Performer C:\Programs\MediaInfo.exe" . PHP_EOL;

if ($argv) {
    $inputDirectory = $argv[1];
    $outputDirectory = $argv[2];
    $groupKey = $argv[3];
    echo PHP_EOL . "+++ Starting music group on directory " . $inputDirectory . " and grouping by " . $groupKey . PHP_EOL;

    $musicNicifier = new \scripts\MusicNicifier();
    $musicNicifier->helperObjects['songMover'] = new \filehelpers\File\Actions();
    $musicNicifier->helperObjects['songLoader'] = new \filehelpers\Directory\Listing();
    $musicNicifier->helperObjects['metadataLoader'] = new \filehelpers\File\Metadata();
    if ($argv > 4) {
        $musicNicifier->helperObjects['metadataLoader']->pathToMediaInfo = $argv[4];
    }
    $musicNicifier->helperObjects['fileFactory'] = new \filehelpers\File\ModelFactory();

    $musicNicifier->organizeSongsByMetadata($inputDirectory, $outputDirectory, $groupKey);
}

