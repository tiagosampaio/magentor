<?php

namespace Magentor\Framework\SimpleXML;

class Element extends \SimpleXMLElement
{
    
    /** @var Element */
    protected $_parent = null;
    
    
    /**
     * For future use
     *
     * @param Element $element
     *
     * @return Element
     */
    public function setParent(Element $element)
    {
        $this->_parent = $element;
        return $this;
    }
    
    
    /**
     * Returns parent node for the element
     *
     * Currently using xpath
     *
     * @return Element
     */
    public function getParent()
    {
        if (!empty($this->_parent)) {
            $parent = $this->_parent;
        } else {
            $arr = $this->xpath('..');
            $parent = $arr[0];
        }
        
        return $parent;
    }
    
    
    /**
     * @return bool
     */
    public function hasChildren()
    {
        if (!$this->children()) {
            return false;
        }
        
        // SimpleXML bug: @attributes is in children() but invisible in foreach
        foreach ($this->children() as $k => $child) {
            return true;
        }
        
        return false;
    }
    
    
    /**
     * Returns attribute value by attribute name
     *
     * @return string
     */
    public function getAttribute($name){
        $attributes = $this->attributes();
        return isset($attributes[$name]) ? (string) $attributes[$name] : null;
    }
    
    
    /**
     * Makes nicely formatted XML from the node
     *
     * @param string $filename
     * @param int|boolean $level if false
     * @return string
     */
    public function asNiceXml($filename='', $level=0)
    {
        if (is_numeric($level)) {
            $pad = str_pad('', $level*3, ' ', STR_PAD_LEFT);
            $nl = "\n";
        } else {
            $pad = '';
            $nl = '';
        }
        
        $out = $pad.'<'.$this->getName();
        
        if ($attributes = $this->attributes()) {
            foreach ($attributes as $key=>$value) {
                $out .= ' '.$key.'="'.str_replace('"', '\"', (string)$value).'"';
            }
        }
        
        if ($this->hasChildren()) {
            $out .= '>'.$nl;
            foreach ($this->children() as $child) {
                $out .= $child->asNiceXml('', is_numeric($level) ? $level+1 : true);
            }
            $out .= $pad.'</'.$this->getName().'>'.$nl;
        } else {
            $value = (string)$this;
            if (strlen($value)) {
                $out .= '>'.$this->xmlEntities($value).'</'.$this->getName().'>'.$nl;
            } else {
                $out .= '/>'.$nl;
            }
        }
        
        if ((0===$level || false===$level) && !empty($filename)) {
            file_put_contents($filename, $out);
        }
        
        return $out;
    }
    
    
    /**
     * Converts meaningful xml characters to xml entities
     *
     * @param  string
     * @return string
     */
    public function xmlEntities($value = null)
    {
        if (is_null($value)) {
            $value = $this;
        }
        $value = (string)$value;
        
        $value = str_replace(
            array('&', '"', "'", '<', '>'),
            array('&amp;', '&quot;', '&apos;', '&lt;', '&gt;'),
            $value
        );
        
        return $value;
    }
    
    
    /**
     * Appends $source to current node
     *
     * @param Element $source
     *
     * @return Element
     */
    public function appendChild(Element $source)
    {
        if ($source->children()) {
            /**
             * @see http://bugs.php.net/bug.php?id=41867 , fixed in 5.2.4
             */
            if (version_compare(phpversion(), '5.2.4', '<')===true) {
                $name = $source->children()->getName();
            } else {
                $name = $source->getName();
            }
            
            /** @var Element $child */
            $child = $this->addChild($name);
        } else {
            $child = $this->addChild($source->getName(), $this->xmlEntities($source));
        }
        
        $child->setParent($this);
        
        $attributes = $source->attributes();
        
        foreach ($attributes as $key=>$value) {
            $child->addAttribute($key, $this->xmlEntities($value));
        }
        
        /** @var Element $sourceChild */
        foreach ($source->children() as $sourceChild) {
            $child->appendChild($sourceChild);
        }
        
        return $this;
    }
    
    
    /**
     * Extends current node with xml from $source
     *
     * If $overwrite is false will merge only missing nodes
     * Otherwise will overwrite existing nodes
     *
     * @param Element $source
     * @param boolean $overwrite
     *
     * @return Element
     */
    public function extend(Element $source, bool $overwrite = false)
    {
        if (!$source instanceof Element) {
            return $this;
        }
        
        foreach ($source->children() as $child) {
            $this->extendChild($child, $overwrite);
        }
        
        return $this;
    }
    
    
    /**
     * Extends one node
     *
     * @param Element $source
     * @param boolean $overwrite
     * @return Element
     */
    public function extendChild($source, $overwrite=false)
    {
        // this will be our new target node
        $targetChild = null;
        
        // name of the source node
        $sourceName = $source->getName();
        
        // here we have children of our source node
        $sourceChildren = $source->children();
        
        if (!$source->hasChildren()) {
            // handle string node
            if (isset($this->$sourceName)) {
                // if target already has children return without regard
                if ($this->$sourceName->hasChildren()) {
                    return $this;
                }
                if ($overwrite) {
                    unset($this->$sourceName);
                } else {
                    return $this;
                }
            }
            
            /** @var Element $targetChild */
            $targetChild = $this->addChild($sourceName, $source->xmlEntities());
            $targetChild->setParent($this);
            foreach ($source->attributes() as $key=>$value) {
                $targetChild->addAttribute($key, $this->xmlEntities($value));
            }
            return $this;
        }
        
        if (isset($this->$sourceName)) {
            $targetChild = $this->$sourceName;
        }
        
        if (is_null($targetChild)) {
            // if child target is not found create new and descend
            $targetChild = $this->addChild($sourceName);
            $targetChild->setParent($this);
            foreach ($source->attributes() as $key=>$value) {
                $targetChild->addAttribute($key, $this->xmlEntities($value));
            }
        }
        
        // finally add our source node children to resulting new target node
        foreach ($sourceChildren as $childKey=>$childNode) {
            $targetChild->extendChild($childNode, $overwrite);
        }
        
        return $this;
    }
    
    
    /**
     * @param string $path
     * @param        $value
     * @param bool   $overwrite
     *
     * @return $this
     */
    public function setNode(string $path, $value, $overwrite = true)
    {
        $arr1 = explode('/', $path);
        $arr = array();
        foreach ($arr1 as $v) {
            if (!empty($v)) $arr[] = $v;
        }
        $last = sizeof($arr)-1;
        $node = $this;
        
        foreach ($arr as $i=>$nodeName) {
            if ($last===$i) {
                if (!isset($node->$nodeName) || $overwrite) {
                    // http://bugs.php.net/bug.php?id=36795
                    // comment on [8 Feb 8:09pm UTC]
                    if (isset($node->$nodeName) && (version_compare(phpversion(), '5.2.6', '<')===true)) {
                        $node->$nodeName = $node->xmlEntities($value);
                    } else {
                        $node->$nodeName = $value;
                    }
                }
            } else {
                if (!isset($node->$nodeName)) {
                    $node = $node->addChild($nodeName);
                } else {
                    $node = $node->$nodeName;
                }
            }
            
        }
        return $this;
    }
    
    
    /**
     * Add CDATA text in a node
     * @param string $cdata_text The CDATA value  to add
     */
    private function addCData($cdata_text)
    {
        $node= dom_import_simplexml($this);
        $no = $node->ownerDocument;
        $node->appendChild($no->createCDATASection($cdata_text));
    }
    
    
    /**
     * Create a child with CDATA value
     * @param string $name The name of the child element to add.
     * @param string $cdata_text The CDATA value of the child element.
     */
    public function addChildCData($name,$cdata_text)
    {
        /** @var Element $child */
        $child = $this->addChild($name);
        $child->addCData($cdata_text);
    }
    
    
    /**
     * Add XmlElement code into a SimpleXMLElement
     * @param Element $append
     */
    public function append(Element $append)
    {
        if ($append) {
            if (strlen(trim((string) $append)) == 0) {
                /** @var Element $xml */
                $xml = $this->addChild($append->getName());
                
                /** @var Element $child */
                foreach($append->children() as $child) {
                    $xml->append($child);
                }
            } else {
                $xml = $this->addChild($append->getName(), (string) $append);
            }
            foreach($append->attributes() as $n => $v) {
                $xml->addAttribute($n, $v);
            }
        }
    }
}
