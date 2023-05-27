<?php
function setFilePermissions($dir) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        $path = $dir . '/' . $file;
        if (is_dir($path)) {
            setFilePermissions($path);
        } else {
            chmod($path, 0666);
        }
    }
}

$dir = '.';
setFilePermissions($dir);
?>