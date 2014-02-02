<?php

namespace filehelpers;

class DirectoryListing
{
    /**
     * @param $directoryPath
     * @param $recursivelySearchDirectory
     * @return array
     */
    public function getFiles($directoryPath, $recursivelySearchDirectory = false)
    {
        $files = [];
        if ($handle = opendir($directoryPath)) {
            while (false !== ($fileName = readdir($handle))) {
                if (is_dir($fileName)) {
                    $files += $this->getFiles($fileName, $recursivelySearchDirectory);
                }
                $files []= $fileName;
            }
            closedir($handle);
        }

        return $files;
    }
}