<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/25
 * Time: 22:23
 */
function D($modelname) {
    $model = ucfirst($modelname) . "Model";
    $modelPath = MODEL_PATH . $model . ".class.php";
    if (!(file_exists($modelPath))) {
        exit($modelname . "ģ�Ͳ�����");
    }
    require_once($modelPath);
    return Model::getInstance($model);
}