<?php

namespace filehelpers\Directory;

class Listing
{
    /**
     * @param string $directoryPath
     * @param bool $recursivelySearchDirectory
     * @return array
     */
    public function getFiles($directoryPath, $recursivelySearchDirectory = false)
    {
        $Directory = new \RecursiveDirectoryIterator($directoryPath);
        $Iterator = new \RecursiveIteratorIterator($Directory);
        $Regex = new \RegexIterator($Iterator, '/^.+\.mp3$/i', \RecursiveRegexIterator::GET_MATCH);
        return array_keys(iterator_to_array($Regex));;
    }
}