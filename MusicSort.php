<?php

require_once 'filehelpers\FileInterface.php';
require_once 'filehelpers\File\Actions.php';
require_once 'filehelpers\Directory\Listing.php';
require_once 'filehelpers\File\Metadata.php';
require_once 'filehelpers\File\Model.php';
require_once 'filehelpers\File\ModelFactory.php';
require_once 'scripts\MusicNicifier.php';

print "Usage: php MusicSort.php <inputDirectory> <groupByType>" . PHP_EOL;
print "Example: php MusicSort.php C:\Users\Paul\Music Performer" . PHP_EOL;

if ($argv) {
    $directory = $argv[1];
    $groupKey = $argv[2];
    echo "Starting music group on directory " . $directory . " and grouping by " . $groupKey;

    $musicNicifier = new \scripts\MusicNicifier();

    $musicNicifier->helperObjects['songMover'] = new \filehelpers\File\Actions();
    $musicNicifier->helperObjects['songLoader'] = new \filehelpers\Directory\Listing();
    $musicNicifier->helperObjects['metadataLoader'] = new \filehelpers\File\Metadata();
    $musicNicifier->helperObjects['fileFactory'] = new \filehelpers\File\ModelFactory();

    $musicNicifier->organizeSongsByMetadata($directory, $groupKey);
}