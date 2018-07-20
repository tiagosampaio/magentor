<?php

$codeDir = \Magentor\Framework\Filesystem\DirectoryRegistrar::getCodeDir();
$dirs    = scandir($codeDir);

$modules = [];

function validateDirname($dirName)
{
    if ('.' == $dirName || '..' == $dirName) {
        return false;
    }

    return true;
}

foreach ($dirs as $vendor) {
    if (!validateDirname($vendor)) {
        continue;
    }

    $vendorModules = scandir($codeDir . '/' . $vendor);

    foreach ($vendorModules as $module) {
        if (!validateDirname($module)) {
            continue;
        }

        $modules[] = implode(DIRECTORY_SEPARATOR, [$vendor, $module]);
    }
}

return $modules;
