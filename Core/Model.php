<?php

namespace Core;

use App\Exceptions\ConnectDatabaseException;
use PDO;

abstract class Model
{
    protected $db = null;

    public function __construct()
    {
        try {
            if ($this->db === null) {
                $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
                $this->db  = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

                // Throw an Exception when an error occurs
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (\Exception $e) {
            throw new ConnectDatabaseException('Kết nối Database thất bại');
        }
    }

}
