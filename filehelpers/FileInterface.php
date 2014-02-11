<?php

namespace filehelpers;

/**
 * Define necessary file actions.
 *
 * @package filehlpers
 */
interface FileInterface
{
   public function getPath();
   public function setPath($filePath);
}
