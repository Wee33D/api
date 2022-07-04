<?php

declare(strict_types=1);

class Video {
    public $videoname;
    public $videourl;
    public $timeupload;
    public $dateupload;
    


    public function JsonSerializable(){
    
        return [
            'id' => $this->id,
            'videoname'=> $this->videoname,
            'videourl'=> $this->videourl,
            'timeupload'=> $this->timeupload,
            'dateupload'=> $this->dateupload
            
        ];
    }
}

