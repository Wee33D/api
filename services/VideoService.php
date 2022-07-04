<?php
// require 'Database/db.php';
require 'models/Video.php';

class VideoService {
    private $db;

    public function __construct(){
        $this->db = getDatabase()->connect();
    }


    function insertVideo($name,$timeup,$dateup,$url){
        try{
            $sql = "INSERT INTO videos(name, url, timeup, dateup) VALUES (:name,:ourl,:timeup,:dateup,NOW())";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("name",$name);
            $stmt->bindParam("url",$url);
            $stmt->bindParam("timeup",$timeup);
            $stmt->bindParam("dateup",$dateup);

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
                $video->videoname=$row['videoname'];
                $video->videourl=$row['videourl'];
                $video->timeupload=$row['timeupload'];
                $video->dateupload=$row['dateupload'];
                # code...
            }
            # code...
        }
        return $video;
    }
    
}