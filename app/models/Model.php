<?php

namespace app\models;

use PDO;

class Model
{
	
    public $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }

}