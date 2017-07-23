<?php

namespace EaCms;

use EaCms\Core\Factory\CoreFactory;
use EaCms\Core\Management\UserManage;
use EaCms\Pages\Loading\PageLoader;
use EaCms\Themes\ThemeLocator;



/**
 * Core class of the application
 */
class EaCore {
    
    // Loadable plugins
    protected $plugins = [];
    
    // Loadable themes
    protected $themes = [];
    
    /**
     * Private contructor for singleton
     */
    private function __construct() {}
    private function __clone() {}

    /**
     * Call this method to get the core
     */
    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new EaCore();
        }
        return $inst;
    }

    /**
     * Load a plugin into the core module
     */
    public function loadPlugin($handle) {
        
        
        
        return $id;
    }

    /**
     * Load a plugin into the core module
     */
    public function registerPlugin($handle, $name = null, $id = null) {
        
        
        
        return $id;
    }

    public function init() {
        $pageLoader = new PageLoader($this);
	$pageLoader->load("page.phtml", true);
    }

    public function initThemes() {
        $themes = ThemeLocator::go();
        var_dump($themes);
    }
}
