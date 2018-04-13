<?php

error_reporting(E_ALL);
#ini_set('display_errors', 1);

// include_once './etc/functions.php';

require_once ROOT . '/app/autoload.php';

$templates = ROOT . '/repository/templates';
$loader = new \Twig\Loader\FilesystemLoader($templates);
$twig   = new \Twig\Environment($loader, [
    // 'cache' => ROOT . '/to/compilation_cache'
]);

/** @var \Twig\TemplateWrapper $template */
/*
try {
    $template = $twig->load('magento1/module/xml/declaration.twig');
    $data = $template->render([
        'vendor'       => 'MagedIn',
        'module_name'  => 'Example',
        'dependencies' => [
            'Mage_Catalog',
            'Mage_Core'
        ],
    ]);

    file_put_contents(ROOT . '/declaration.xml', $data);

} catch (Exception $e) {
    $x = '';
}
*/

\Magentor\Framework\Filesystem\DirectoryRegistrar::register(ROOT);

$bootstrap = \Magentor\Framework\App\Bootstrap::create(ROOT, $_SERVER);
$bootstrap->createApplication()->run();
