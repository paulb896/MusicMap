<?php

namespace scripts;

/**
 * Copy music to directories specified by
 * metadata types. For example, copy all music into
 * directories matching all files 'Performer' (aka Artist) attribute.
 */
class MusicNicifier
{
    protected $metadataGroupByName;
    protected $baseDirectory;

    /**
     * Instances of external helper objects.
     *
     * @type array
     */
    public $helperObjects = [
        'songMover' => '',
        'songLoader' => '',
        'fileFactory' => '',
        'metadataLoader' => ''
    ];

    /**
     * @param string $inputDirectory
     * @param string $metadataGroupKey
     * @param null (optional) $metadataScriptPath
     */
    public function organizeSongsByMetadata($inputDirectory, $metadataGroupKey, $metadataScriptPath = null)
    {
        $this->setBaseDirectory($inputDirectory);

        $this->setMetadataGroupKey($metadataGroupKey);

        if (!is_null($metadataScriptPath)) {
            $this->helperObjects['metadataLoader']->pathToMediaInfo = $metadataScriptPath;
        }

        $songs = $this->helperObjects['songLoader']->getFiles($inputDirectory);

        $this->moveSongs($songs);
    }

    /**
     * @param string $metadataName
     */
    public function setMetadataGroupKey($metadataName)
    {
        if (is_string($metadataName)
            && strlen($metadataName) > 3
        ) {
            $this->metadataGroupByName = $metadataName;
        }
    }

    /**
     * Set valid directory.
     *
     * @param string $baseDirectory
     * @throws \Exception On invalid directory.
     */
    public function setBaseDirectory($baseDirectory)
    {
        if (is_dir($baseDirectory)) {
            $this->baseDirectory = $baseDirectory;
        }
    }

    public function getDirectoryName($file)
    {
        if (!array_key_exists($this->metadataGroupByName, $file->metadata)) {
            throw new \Exception('Incomplete file metadata');
        }
        return $file->metadata[$this->metadataGroupByName];
    }

    public function getTrackName($file)
    {
        if (!array_key_exists('Track name', $file->metadata)) {
            throw new \Exception('Incomplete file metadata');
        }
        return $file->metadata['Track name'];
    }

    /**
     * @param string $file
     * @throws \Exception On invalid metadata (indirectly)
     * @return string
     */
    public function getSongDestinationPath($file)
    {
        $extension = '.mp3';
        return $this->getDirectoryName($file)
            . DIRECTORY_SEPARATOR
            . str_replace(' ', '_', $this->getTrackName($file))
            . $extension;
    }

    /**
     * @param array $songs
     */
    public function moveSongs($songs)
    {
        foreach($songs as $song) {
            $songFile = $this->helperObjects['fileFactory']->getFile($song);
            try {
                $this->helperObjects['metadataLoader']->loadMetadata($songFile);
                $destinationPath = $this->getSongDestinationPath($songFile);
            } catch (\Exception $e) {
                continue;
            }

            $directoryName = $this->getDirectoryName($songFile);
            if (!is_dir($directoryName)) {
                mkdir($directoryName);
            }
            $this->helperObjects['songMover']->copy($songFile, $destinationPath);
        }
    }
}

