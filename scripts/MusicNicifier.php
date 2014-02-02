<?php

namespace scripts;

/**
 * Copy music to directories specified by
 * metadata types. For example, copy all music into
 * directories matching all files 'Performer' (aka Artist) attribute.
 */
class MusicNicifier
{
    /**
     * Instances of external helper objects.
     *
     * @type array
     */
    protected $helpers = [
        'songMover' => '',
        'songLoader' => '',
        'metaDataLoader' => ''
    ];

    /**
     * @type array
     */
    protected $validCommandLineArguments = [];

    /**
     * @param array $commandLineArguments
     */
    public function execute($commandLineArguments)
    {
        if (array_key_exists('inputDir', $commandLineArguments)) {
            $this->setBaseDirectory($commandLineArguments['inputDir']);
        }

        if (array_key_exists('metadataScriptPath', $commandLineArguments)) {
            $this->helpers['metaDataLoader']->pathToMediaInfo = $commandLineArguments['metadataScriptPath'];
        }

        //$this->moveSongs()
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

    public function getSongDestinationPath($testFile)
    {
        $this->helpers['metaDataLoader']->loadMetadata($testFile);
        //return $testF
    }

    /**
     *
     */
    public function moveSongs($songs)
    {
        foreach($songs as $song) {
            $songFile = $this->helpers['songLoader']->loadFile($song);
            $destinationPath = $this->getSongDestinationPath($songFile);
            $this->helpers['songMover']->copyFileToPath($songFile, $destinationPath);
        }
    }

    protected $baseDirectory;
}