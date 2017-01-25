<?php
/**
 * Created by PhpStorm.
 * User: uoouki
 * Date: 2017/1/12
 * Time: 15:22
 */
namespace Uooki\Validor;

/**
 * Interface ValidationInterface
 * @package Uooki\Validor
 */
interface ValidationInterface
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return mixed
     */
    public function getRule();
}