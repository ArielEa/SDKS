<?php

namespace packages\kernel\yaml;

abstract class yamlInstances
{
    public function __construct(){}

    private function __clone(){}

    const YAML_PARAMETERS = "parameters";

    const YAML_DOCTRINE = "doctrine";

    const YAML_IMPORTS = "imports";

    private static $yamlParametersInstances = [];

    private static function setInstance($key, $object)
    {
        self::$yamlParametersInstances[$key] = $object;
    }

    private static function getInstance($key)
    {
        return self::$yamlParametersInstances[$key];
    }

    private static function hasInstance($key)
    {
        return isset(self::$yamlParametersInstances[$key]);
    }

    public static function save($key, $object)
    {
        // 不管存在与否，都要重新设置
        self::setInstance($key, $object);
    }

    public static function get($index = self::YAML_PARAMETERS, $columns = "")
    {
        if (!self::hasInstance($index)) {
            return null;
        }

        $object = self::getInstance($index);

        if ($columns) {
            if (isset($object[$columns]))
                return $object[$columns];
        }
        return $object;
    }
}