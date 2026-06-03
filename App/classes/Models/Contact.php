<?php

namespace App\Classes\Models;

use App\Classes\Core\Database;




class Contact
{


    private Database $db;


    public function __construct()
    {
        $this->db = new Database();
        $this->db->connect();
    }

    public function contactdb($user_id, $name, $email, $mes)
    {

        $sql = "INSERT INTO contacts (`user_id`,`name`,`email`,`message`) values(?,?,?,?)";
        $params = [$user_id, $name, $email, $mes];
        $this->db->query($sql, $params);
        return true;
    }
    public function getallcontact()
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
        return $this->db->query($sql, $params)->fetchAll();
    }
    public function markAsRead($id)
    {
        $sql = "UPDATE contacts
            SET is_read = 1
            WHERE id = ?";

        $params = [$id];

        return $this->db->query($sql, $params);
    }
    // public function delete(){

    // }

}
