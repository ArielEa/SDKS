<?php

namespace packages;

use packages\kernel\yaml\YamlContainer;
use packages\routes\routesContainer;

/**
 * 解决文件的解析问题
 * Class Terminal
 * @package packages
 */
abstract class Terminal
{
    public function __construct(){}

    private function __clone(){}

    const Terminal_Return_ARRAY = "array";

    const Terminal_Return_OBJECT = "object";

    const Terminal_Return_STRING = "string";

    public static function routes($returnStatus)
    {
        routesContainer::routeStarter();
    }

    public static function terminal()
    {
        // 依次执行控制器
        // 1、yaml配置文件读取、存储
        self::yaml_commit();
    }

    /**
     * 读取和存储，不返回数据
     */
    private static function yaml_commit()
    {
        YamlContainer::configurationPool();
    }

    private static function routes_cache()
    {

    }
}