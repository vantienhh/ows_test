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
            ->prepare("SELECT id, name, address, email FROM " . $this->table . " WHERE email = :email AND password = :password LIMIT 1");

        $query->execute(array(
            ':email'    => $email,
            ':password' => $password
        ));

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = $this->db
            ->prepare("SELECT id, name, address, email FROM " . $this->table . " WHERE id = :id LIMIT 1");

        $query->execute(array(
            ':id' => $id
        ));

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, array $data)
    {
        $query = $this->db
            ->prepare("UPDATE " . $this->table . " SET name = :name, address = :address WHERE id = :id");

        $query->execute(array(
            ':id'      => $id,
            ':name'    => $data['name'],
            ':address' => $data['address'],
        ));
        return $this->getById($id);
    }

}
