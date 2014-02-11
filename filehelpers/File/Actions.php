<?php

namespace filehelpers\File;

use \filehelpers\FileInterface;

class Actions
{
    /**
     * Copy file from current path to a given destination.
     *
     * @param FileInterface $file
     * @param string $destinationPath
     */
    public function copy(FileInterface $file, $destinationPath)
    {
        copy($file->getPath(), $destinationPath);
    }
}