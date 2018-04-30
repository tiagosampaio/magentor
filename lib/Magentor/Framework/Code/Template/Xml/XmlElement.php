<?php

namespace Magentor\Framework\Code\Template\Xml;

class XmlElement extends \SimpleXMLElement
{
    
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
        /** @var XmlElement $child */
        $child = $this->addChild($name);
        $child->addCData($cdata_text);
    }
    
    
    /**
     * Add XmlElement code into a SimpleXMLElement
     * @param XmlElement $append
     */
    public function append(XmlElement $append)
    {
        if ($append) {
            if (strlen(trim((string) $append)) == 0) {
                /** @var XmlElement $xml */
                $xml = $this->addChild($append->getName());
                
                /** @var XmlElement $child */
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
