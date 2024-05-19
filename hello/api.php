<?php
$videosDirectory = 'videos/';
$video_extensions = ['mp4', 'avi', 'mkv', 'mov']; // Add or remove video file extensions as needed

$video_array = getVideoFiles($videosDirectory, $video_extensions);

if (count($video_array) == 0) {
    die('No video files found in the specified directory.');
}

$randomVideo = $video_array[array_rand($video_array)];

$videoMimeType = getMimeType($randomVideo);
header('Content-Type: ' . $videoMimeType);
readfile($randomVideo);

function getVideoFiles($directory, $extensions)
{
    $videoFiles = [];

    foreach ($extensions as $ext) {
        $pattern = $directory . '*.' . $ext;
        $videoFiles = array_merge($videoFiles, glob($pattern));
    }

    return $videoFiles;
}

function getMimeType($file)
{
    $extension = pathinfo($file, PATHINFO_EXTENSION);

    switch ($extension) {
        case 'mp4':
            return 'video/mp4';
        case 'avi':
            return 'video/x-msvideo';
        case 'mkv':
            return 'video/x-matroska';
        case 'mov':
            return 'video/quicktime';
        // Add more cases for other video file extensions as needed
        default:
            return 'application/octet-stream';
    }
}
?>
