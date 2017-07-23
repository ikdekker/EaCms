<?php

namespace EaCms\Pages\Loading;

use EaCms\Pages\Renderer\DefaultRenderer;

class PageLoader {
    
    protected $context;
    protected $domain;
    protected $renderer;
        
    public function __construct($context, $domain = "view/" , $renderer = null) {
            $this->setContext($context);
            if (!$renderer) {
                $renderer = new DefaultRenderer();
            }
            $this->setRenderer($renderer);
            $this->setDomain($domain);
            
            
    }

    public function load($page, $render = false) {
         $domain = $this->getDomain();
         $content = file_get_contents(ROOTPATH . $domain . $page);
         if ($render) {
             echo $content;
         }
         return $content;
    }
    
    public function getContext() {
        return $this->context;
    }
    
    public function setContext($context) {
        $this->context = $context;
        return $this;
    }
    public function getRenderer() {
        return $this->renderer;
    }
    
    public function setRenderer($renderer) {
        $this->renderer = $renderer;
        return $this;
    }
    public function getDomain() {
        return $this->domain;
    }
    
    public function setDomain($domain) {
        $this->domain = $domain;
        return $this;
    }
    
    
}
