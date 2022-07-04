<?php
// require 'Database/db.php';
require 'models/Video.php';

class VideoService {
    private $db;

    public function __construct(){
        $this->db = getDatabase()->connect();
    }


    function insertVideo($videoname,$timeupload,$dateupload,$videourl){
        try{
            $sql = "INSERT INTO videos(videoname, videourl, timeupload, dateupload) VALUES (:videoname,:videourl,:timeupload,:dateupload,NOW())";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("videoname",$videoname);
            $stmt->bindParam("videourl",$videourl);
            $stmt->bindParam("timeupload",$timeuplaod);
            $stmt->bindParam("dateupload",$dateupload);

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