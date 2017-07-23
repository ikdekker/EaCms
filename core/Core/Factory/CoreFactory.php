<?php

namespace EaCms\Core\Factory;

use EaCms\Core\Patterns\Singleton\Singleton;

/**
 * Description of coreFactory
 *
 * @author Nick
 */
class CoreFactory extends Singleton {

    protected $classes;

    protected function __construct() {
        $registrations = [
            'db-connector' => [
                'EaCms\Core\Database\Communication\DbConnector'
            ],
        ];
        foreach ($registrations as $name => $config) {
            array_unshift($config, $name);
            call_user_func_array([$this, 'registerClass'], $config);
        }
    }

    public function get($name) {
        if (isset($this->classes[$name])) {
            return $this->classes[$name];
        }
        return false;
    }

    public function registerClass($name, $namespace, $options = []) {
        $newClass = $namespace::getInstance();
        foreach ($options as $value) {
            if (is_scalar($value)) {
                $newClass->$value();
                return true;
            }
            if (!is_array($value)) {
                return false;
            }
            $cnt = count($value);
            if ($cnt === 1) {
                $newClass->$value[0]();
            } elseif ($cnt > 1) {
                call_user_func_array([$newClass, $value[0]], array_shift($value));
            }
        }
        $this->classes[$name] = $newClass;
    }

}
