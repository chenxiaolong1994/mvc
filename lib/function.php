<?php
function D($modelname) {
    $model = ucfirst($modelname) . "Model";
    $modelPath = MODEL_PATH . $model . ".class.php";
    if (!(file_exists($modelPath))) {
        exit($modelname . "不存在");
    }
    require_once($modelPath);
    return Model::getInstance($model);
}

function WriteLog($data) {
    $filename = LOG_PATH . "log.txt";
    $fp = fopen($filename,"a+b");
    fwrite($fp,var_export($data));
}