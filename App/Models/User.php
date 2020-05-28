<?php

namespace App\Models;

use Core\Model;
use PDO;

class User extends Model
{
    public $table = 'users';

    public function getAccount($email, $password)
    {
        $query = $this->db
            ->prepare("SELECT * FROM " . $this->table . " WHERE email = :email AND password = :password LIMIT 1");

        $query->execute(array(
            ':email'    => $email,
            ':password' => $password
        ));

        return $query->fetch(PDO::FETCH_ASSOC);
    }

}
