<?php

namespace Magentor\Framework\Magento\Info;

use Magentor\Framework\Magento\ApplicationInterface;

class Builder
{

    /** @var DescriberInterface */
    protected $describer;

    /**
     * @param ApplicationInterface $magento
     *
     * @return Version\InfoInterface
     */
    public function build(ApplicationInterface $magento)
    {
        if ($this->describer()->isMagentoOne()) {
            $info = new Version\MagentoOne($magento);
        } elseif ($this->describer()->isMagentoTwo()) {
            $info = new Version\MagentoTwo($magento);
        } else {
            $info = new Version\NotMagento($magento);
        }

        return $info;
    }


    /**
     * @return DescriberInterface
     */
    protected function describer()
    {
        if (empty($this->describer)) {
            $this->describer = new Describer();
        }

        return $this->describer;
    }
}
