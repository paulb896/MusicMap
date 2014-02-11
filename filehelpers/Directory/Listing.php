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
            $files = [];
            if ($handle = opendir($directoryPath)) {
                while (false !== ($fileName = readdir($handle))) {
                    if (
                        (strlen($fileName) > 3)
                        && is_dir($fileName)
                        && $recursivelySearchDirectory
                    ) {
                        $files += $this->getFiles($fileName, $recursivelySearchDirectory);
                    }
                if (strpos($fileName, '.mp3')) {
                    $files []= $fileName;
                }
            }
            closedir($handle);
        }

        return $files;
    }
}