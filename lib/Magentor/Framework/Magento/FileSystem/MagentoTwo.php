<?php

namespace Magentor\Framework\Magento\FileSystem;

class MagentoTwo implements FileSystemInterface
{
    
    const PUB_INDEX                  = 'pub/index.php';
    const ETC_DI_XML                 = 'app/etc/di.xml';
    const ETC_BOOTSTRAP              = 'app/bootstrap.php';
    const ETC_COMPONENT_REGISTRATION = 'app/etc/NonComposerComponentRegistration.php';
}
