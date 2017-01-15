<?php
/**
 * Created by PhpStorm.
 * User: uoouki
 * Date: 2017/1/12
 * Time: 15:56
 */

namespace Uooki\Validor;


class ValidConst
{
    const VERSION="1.0.0";
    const VALID_TYPE_NAME='username';
    const VALID_TYPE_EMAIL='email';
    const VALID_TYPE_PHONE='phone';
    const VALID_TYPE_PWD='pwd';
    const VALID_TYPE_REPWD='repwd';

    const VALID_RULE_REQUIRE='required';
    const VALID_RULE_MIN='min';   // min:xxx
    const VALID_RULE_MAX='max';   // max:xxx
    const VALID_RULE_SAME='same';
    const VALID_RULE_UNIQUE='unique';
    const VALID_RULE_REGEX='regex'; // regex:xxx
    const VALID_RULE_CALLBACK='callback'; //callbacks :xxx|xxx|xxx

    const REG_NAME="/^[\x{4E00}-\x{9FA5}a-zA-Z-_]{4,20}$/u";
    const REG_EMAIL="";
    const REG_PHONE="/^1(3|4|5|7|8)\d{9}$/";
    const REG_IP="";
    const REG_URL="";

}