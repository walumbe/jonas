<?php

namespace app\core;

/**
 * @author Jonathan Walumbe <nathanwalumbe@gmail.com>
 * @package app\core
 */
abstract class UserModel extends DBModel
{

    abstract public function getDisplayname():string;

}
