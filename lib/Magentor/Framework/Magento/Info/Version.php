<?php

namespace Magentor\Framework\Magento\Info;

class Version
{

    /** @var Version\InfoInterface */
    protected $info;

    public function __construct(Version\InfoInterface $info)
    {
        $this->info = $info;
    }
}
