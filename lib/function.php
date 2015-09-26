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
        exit($modelname . "模型不存在");
    }
    require_once($modelPath);
    return Model::getInstance($model);
}