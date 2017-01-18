<?php

//echo "\nthis is hook for commit\n";

// 输出当前路径
$pwd = `pwd`;
//echo $pwd;

// 获取当前分支名 是否是master
$current_branch=`git branch  -vv | sed '/\*/!d'| awk -F" "  '{print $2}'`;
//var_dump(trim($current_branch));


// 获取触发合并的命令值
$mc=`git reflog | head -1 | awk  -F":" '{print $2}'`;
$merge_command=trim($mc," :");

//var_dump($merge_command);

$command=explode(" ",$merge_command);
// 检查是否是： git merge dev master

$len=count($command);

if($len>1){
    // merge

}else{
    // commit(merge)

}







