<?php

namespace App\Models;

use Core\Model;
use PDO;

class Token extends Model
{
    public $table = 'tokens';

    public function findAndNew(array $data)
    {
        if (!$this->findByUserAndToken($data)) {
            $this->store($data);
        }
    }

    public function findByUserAndToken(array $data)
    {
        $query = $this->db
            ->prepare("SELECT * FROM " . $this->table . " WHERE user_id = :user_id AND token = :token LIMIT 1");

        $query->execute(array(
            ':user_id' => $data['user_id'],
            ':token'   => $data['token']
        ));

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function findByToken($token)
    {
        $query = $this->db
            ->prepare("SELECT * FROM " . $this->table . " WHERE token = :token LIMIT 1");

        $query->execute(array(
            ':token' => $token
        ));

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function store(array $data)
    {
        $query = $this->db
            ->prepare("INSERT INTO " . $this->table . " (user_id, token) VALUES (?, ?)");

        $query->execute(array($data['user_id'], $data['token']));
    }

    public function delete($token, $userId)
    {
        $query = $this->db
            ->prepare("DELETE FROM " . $this->table . " WHERE token = :token AND user_id = :user_id");

        $query->execute(array(
            ':token'  => $token,
            ':user_id' => $userId
        ));
    }

}
