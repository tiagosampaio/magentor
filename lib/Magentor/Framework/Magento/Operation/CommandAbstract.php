<?php

namespace Magentor\Framework\Magento\Operation;


use Magentor\Framework\Magento\ApplicationInterface;

abstract class CommandAbstract implements CommandInterface
{

    /** @var ApplicationInterface */
    protected $magento;


    /**
     * CommandAbstract constructor.
     *
     * @param ApplicationInterface $magento
     */
    public function __construct(ApplicationInterface $magento)
    {
        $this->magento = $magento;
    }


    /**
     * @param string $class
     * @param array  $parameters
     *
     * @return bool|mixed
     *
     * @throws \Exception
     */
    protected function executeCommand($class, array $parameters = [])
    {
        if (!class_exists($class)) {
            $this->magento
                ->exceptionContainer()
                ->throwGenericException("Magento operation method {$class} class does not exist.");
        }

        /** @var MethodInterface $method */
        $method = new $class($this->magento);

        if (!($method instanceof MethodInterface)) {
            $this->magento
                ->exceptionContainer()
                ->throwGenericException("Magento operation method must be an instance of ".MethodInterface::class.".");
        }

        if (true == $method->requiresMagentoInitialization()) {
            $this->magento->getBootstrapper()->initializeMagento();
        }

        /**
         * If it's a Magento One application.
         */
        if ($this->magento->getInfo()->isMagentoOne()) {
            return call_user_func_array([$method, 'executeMagentoOne'], $parameters);
        }

        /**
         * If it's a Magento Two application.
         */
        if ($this->magento->getInfo()->isMagentoTwo()) {
            return call_user_func_array([$method, 'executeMagentoTwo'], $parameters);
        }

        /**
         * If it's not a Magento application.
         */
        if ($this->magento->getInfo()->isNotMagento()) {
            return call_user_func_array([$method, 'execute'], $parameters);
        }

        return false;
    }
}
