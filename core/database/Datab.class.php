<?php

namespace Lolly;

use Medoo\Medoo;

require(Lolly . 'core/database/Medoo.php');

class Datab extends Medoo{
    public function __construct()
    {
        $config = require(Lolly . '/app/config/database.php');
        parent::__construct($config);
    }
}