<?php

namespace Magentor\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\ConfigElement;

class Routes extends ConfigElement
{
    
    /**
     * @param string $id
     * @param string $frontName
     *
     * @return $this
     */
    public function addRoute(string $module, string $routeId = null, string $frontName = null, bool $isAdmin = false)
    {
        if (empty($routeId)) {
            $routeId = $module;
        }
        
        if (empty($frontName)) {
            $frontName = $module;
        }
        
        $route = $this->router()->addChild('route');
        $route->addAttribute('id', strtolower($routeId));
        $route->addAttribute('frontName', strtolower($frontName));
        
        $routeModule = $route->addChild('module');
        $routeModule->addAttribute('name', $module);
        
        if (true === $isAdmin) {
            $routeModule->addAttribute('before', 'Magento_Backend');
        }
        
        return $this;
    }
    
    
    /**
     * @param string $routerId
     *
     * @return $this
     */
    public function setRouterId(string $routerId)
    {
        $this->router()->addAttribute('id', $routerId);
        return $this;
    }
    
    
    /**
     * @return bool|ConfigElement
     */
    public function router()
    {
        $this->initialize();
        return $this->node('router');
    }
    
    
    /**
     * @return $this
     */
    protected function initialize()
    {
        if (false === $this->node('router')) {
            $this->addChild('router');
        }
        
        return $this;
    }
}
