<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('BS', '\\');

require_once ROOT . '/app/autoload.php';

\Magentor\Framework\Filesystem\DirectoryRegistrar::register(ROOT);

$bootstrap = \Magentor\Framework\App\Bootstrap::create(ROOT, $_SERVER);

try {
    $bootstrap->createApplication()->run();
} catch (\Magentor\Framework\Exception\PhpVersionException $e) {
    $message = $e->getMessage();

    echo escapeHtml($message);
} catch (Exception $e) {
    /**
     * @todo Throw the error again.
     */
}
