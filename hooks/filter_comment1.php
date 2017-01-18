<?php
/**
 * 过滤项目中的所有php文件中的注释
 *
 *  方案一： php 的tokenizer
 *  方案二:  使用sed
 *
 *
 * Created by PhpStorm.
 * User: uoouki
 * Date: 2017/1/17
 * Time: 16:59
 */




$root="../src";

// 遍历根目录下所有php文件


// 过滤一个php文件，

$fileStr = file_get_contents('path/to/file');
$newStr  = '';

$commentTokens = array(T_COMMENT);

if (defined('T_DOC_COMMENT'))
    $commentTokens[] = T_DOC_COMMENT; // PHP 5
if (defined('T_ML_COMMENT'))
    $commentTokens[] = T_ML_COMMENT;  // PHP 4

$tokens = token_get_all($fileStr);

foreach ($tokens as $token) {
    if (is_array($token)) {
        if (in_array($token[0], $commentTokens))
            continue;

        $token = $token[1];
    }

    $newStr .= $token;
}

echo $newStr;