<?php
// require 'Database/db.php';
require 'models/Contact.php';

class ContactService{
    private $db;

    public function __construct(){
        $this->db = getDatabase()->connect();
    }

    function insertContact($name, $phonenum, $email){

        try{
            $sql = "INSERT INTO contacts(name, phonenum, email) VALUES (:name, :phonenum, :email)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":phonenum", $phonenum);
            $stmt->bindParam(":email", $email);

            $stmt->execute();

            

            $dbs = new DbResponse();
            $dbs->status = true;
            $dbs->error = "none";
            $dbs->lastinsertid = $this->db->lastInsertId();

            return $dbs;
        } catch (PDOException $e){
            $errorMessage = $e->getMessage();

            $dbs = new DbResponse();
            $dbs->status = false;
            $dbs->error = $errorMessage;

            return $dbs;
        }
    }

    function getAllContacts(){
        $sql = "SELECT * FROM contacts";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row_count = $stmt->rowCount();

        $data = array();

        if($row_count){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $contact = new Contact();
                $contact->id = $row['id'];
                $contact->name = $row['name'];
                $contact->phonenum = $row['phonenum'];
                $contact->email = $row['email'];

                array_push($data, $contact);
            }
        }

        return $data;
    }


    //DISPLAY CONTACT INFO BASED ON ID FOR UPDATE
    function getContactViaId($id)
    {

        $sql = "SELECT *
                FROM contacts
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $row_count = $stmt->rowCount();

        $data = array();

        if ($row_count) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $contact = new Contact();
                $contact->id = $row['id'];
                $contact->name = $row['name'];
                $contact->phonenum = $row['phonenum'];
                $contact->email = $row['email'];

                array_push($data, $contact);
            }
        }

        return $data;
    }


    function updateContactViaId($id, $name, $phonenum, $email)
    {

        $sql = "UPDATE contacts
                SET name = :name,
                    phonenum = :phonenum,
                    email= :email,
                WHERE id = :id";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":phonenum", $phonenum);
            $stmt->bindParam(":email", $email);
            

            $stmt->execute();

            $dbs = new DbResponse();
            $dbs->status = true;
            $dbs->error = "none";

            return $dbs;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();

            $dbs = new DbResponse();
            $dbs->status = false;
            $dbs->error = $errorMessage;

            return $dbs;
        }
    }

    function deleteContactViaId($id)
    {

        $sql = "DELETE FROM contacts WHERE id = :id";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->execute();

            $dbs = new DbResponse();
            $dbs->status = true;
            $dbs->error = "none";

            return $dbs;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();

            $dbs = new DbResponse();
            $dbs->status = false;
            $dbs->error = $errorMessage;

            return $dbs;
        }
    }



}

?>