<?php

declare(strict_types=1);

class Video {
    public $videoname;
    public $timeupload;
    public $dateupload;
    public $videourl;


    public function JsonSerializable(){
    
        return [
            'id' => $this->id,
            'videoname'=> $this->videoname,
            'timeupload'=> $this->timeupload,
            'dateupload'=> $this->dateupload,
            'videourl'=> $this->videourl
        ];
    }
}

