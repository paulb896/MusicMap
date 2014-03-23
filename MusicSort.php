<?php

require_once 'filehelpers\FileInterface.php';
require_once 'filehelpers\File\Actions.php';
require_once 'filehelpers\Directory\Listing.php';
require_once 'filehelpers\File\Metadata.php';
require_once 'filehelpers\File\Model.php';
require_once 'filehelpers\File\ModelFactory.php';
require_once 'scripts\MusicNicifier.php';

echo "Usage: php MusicSort.php <inputDirectory> <outputDirectory> <groupByType> [pathToMediaInfo]" . PHP_EOL;
echo "Example (Default MediaInfoLocation): php MusicSort.php C:\Users\Paul\Music C:\Users\Paul\OrganizedMusic Performer" . PHP_EOL;

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