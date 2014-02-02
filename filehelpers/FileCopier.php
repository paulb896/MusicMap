<?php

namespace filehelpers;

use filehelpers\FileInterface;

class FileCopier
{
    /**
     * Copy file from current path to a given destination.
     *
     * @param FileInterface $file
     * @param string $destinationPath
     */
    public function copyFileToPath(FileInterface $file, $destinationPath)
    {
        copy($file->getPath(), $destinationPath);
    }
}