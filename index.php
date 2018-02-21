<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/22
 * Time: 23:25
 */
$root = dirname(__FILE__);
$root = str_replace("\\","/",$root);
define('ROOT',$root);
$url = $_SERVER['SERVER_NAME'];
$url = "http://" . $url .dirname($_SERVER['PHP_SELF']) . "index.php?";
define('__URL__',$url);
//echo __URL__;
require_once('config/conf.php');
require_once('lib/common.class.php');
require_once('core/model/Model.class.php');
require_once('lib/function.php');
$query_string = $_SERVER['QUERY_STRING'];
$common = common::getInstance();
$query_string = $common->get_query_string($query_string);

$module = isset($_GET['m']) ? $_GET['m'] : "";
$action = isset($_GET['a']) ? $_GET['a'] : "";
$common->route($module,$action,$query_string);
