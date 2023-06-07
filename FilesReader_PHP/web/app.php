<?php

date_default_timezone_set("Asia/Shanghai");

require_once dirname(__DIR__)."/vendor/autoload.php";

require_once dirname(__DIR__)."/public/php_global/global.php";

header("Content-Type:text/html;charset=utf-8");

use packages\Terminal;

Terminal::terminal();