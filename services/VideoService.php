<?php
// require 'Database/db.php';
require 'models/Video.php';

class VideoService {
    private $db;

    public function __construct(){
        $this->db = getDatabase()->connect();
    }



    function insertVideo($sendername,$videourl,$timendateupload){

        try{
            $sql = "INSERT INTO videos(sendername, videourl, timendateupload) VALUES (:sendername,:videourl, NOW() )";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":sendername",$sendername);
            $stmt->bindParam(":videourl",$videourl);
            
            
            $stmt->execute();

            $dbs = new DbResponse();
            $dbs->status = true;
            $dbs->error = "none";
            $dbs->lastinsertid = $this->db->lastInsertId();

            return $dbs;
        }catch (PDOException $e) {
            $errorMessage = $e->getMessage();

            $dbs = new DbResponse();
            $dbs->status = false;
            $dbs->error = $errorMessage;

            return $dbs;
        }
    }

    function getAllVideo(){
        $sql = "SELECT * FROM videos";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row_count = $stmt->rowCount();

        $data = array();

        if ($row_count) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $video = new Video();
                $video->id = $row['id'];
                $video->sendername=$row['sendername'];
                $video->videourl=$row['videourl'];
                $video->timendateupload=$row['timendateupload'];
                
                # code...
                array_push($data, $video);
            }
            
        }
        return $data;
    }
    
}

