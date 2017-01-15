<?php
/**
 * Created by PhpStorm.
 * User: uoouki
 * Date: 2017/1/12
 * Time: 16:11
 */

namespace Uooki\Validor;


abstract class ValidationAbstract
{

    abstract  protected function required($data);

    abstract  protected function min($data,$len);

    abstract  protected function max($data,$len);

    abstract  protected function regular($data,$regex);

    abstract  protected function same($first,$second);

    abstract  protected function unique($data,$connect,$table,$field);
}