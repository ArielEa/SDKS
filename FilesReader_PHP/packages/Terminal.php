<?php

namespace packages;

use packages\kernel\yaml\YamlContainer;

/**
 * 解决文件的解析问题
 * Class Terminal
 * @package packages
 */
abstract class Terminal
{
    public function __construct()
    {
    }

    private function __clone(){}

    public static function terminal()
    {
        // 依次执行控制器
        // 1、yaml配置文件读取、存储
        self::yaml_commit();

        return;
    }

    /**
     * 读取和存储，不返回数据
     */
    private static function yaml_commit()
    {
        YamlContainer::configurationPool();
    }

}