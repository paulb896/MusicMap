Music Organizer
===================

Uses mediainfo to extract song data.

Usage
```
  php MusicSort\MusicSort.php <pathToMusicDirectory> <sortedMusicDestination> <folderGroupMetadataKey> [mediaInfoLocation.exe]
```

Example Usage - Sort music in current directory by performer (aka Artist).
```
  php MusicSort\MusicSort.php C:\Music C:\OrganizedMusic Performer C:\Programs\MediaInfo.exe
```