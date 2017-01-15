<?php
/**
 * Created by PhpStorm.
 * User: uoouki
 * Date: 2017/1/12
 * Time: 15:22
 */
namespace Uooki\Validor;

interface ValidationInterface
{
    public function getData();
    public function getRule();
    public function result();
}