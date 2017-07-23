<?php 

namespace EaCms\Renderer;

class DefaultRenderer implements RendererInterface {
    
    public function render($name, $content) {
        // call global signal
        echo $content;
    }
    
}
