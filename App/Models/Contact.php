<?php

namespace App\Models;

use App\Core\Model;




class Contact extends Model
{




      public function __construct()
    {
        parent::__construct();
    }

    public function contactToDb($user_id, $name, $email, $mes)
    {
        
        $sql = "INSERT INTO contacts (`user_id`,`name`,`email`,`message`) values(?,?,?,?)";
        $params = [$user_id, $name, $email, $mes];
        $this->query($sql, $params);

        return true;
    }
    public function getAllContact()
    {

        $sql = "SELECT
                        *
                FROM 
                        contacts
                ORDER BY 
                        FIELD(is_read, 0, 1),
                        created_at 
                DESC;";

        $params = [];
        return $this->query($sql, $params)->fetchAll();
    }
    public function markAsRead($id)
    {
        $sql = "UPDATE contacts
            SET is_read = 1
            WHERE id = ?";

        $params = [$id];

        return $this->query($sql, $params);
    }

}