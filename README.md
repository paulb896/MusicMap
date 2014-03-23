Music Organizer
===================

Uses mediainfo to extract song data.
MusicSort copies all files from the input directory, to a path based on desired metadata.
Currently only copies mp3 file types.

## Example Case

For example, running the command:

```
php MusicSort\MusicSort.php C:\Music C:\OrganizedMusic Performer C:\Programs\MediaInfo.exe
```

Where C:\Music contains only song.mp3, and song.mp3 the metadata for song.mp3 is:

```
[
 'Performer' => 'Metric',
 'Track name' => 'Gimme Sympathy'
 ...
]
```

The file:
```
 C:\Music\song.mp3
```

would be copied to:

```
 C:\OrganizedMusic\Metric\Gimme_Sympathy.mp3
```


# Usage

```
  php MusicSort\MusicSort.php <pathToMusicDirectory> <sortedMusicDestination> <folderGroupMetadataKey> [mediaInfoLocation.exe]
```

Example - Sort music in current directory by Performer (aka Artist).
```
  php MusicSort\MusicSort.php C:\Music C:\OrganizedMusic Performer C:\Programs\MediaInfo.exe
```