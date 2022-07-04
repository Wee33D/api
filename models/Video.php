<?php

declare(strict_types=1);

class Video {
    public $sendername;
    public $videourl;
    public $timeupload;
    public $dateupload;
    


    public function JsonSerializable(){
    
        return [
            'id' => $this->id,
            'sendername'=> $this->sendername,
            'videourl'=> $this->videourl,
            'timeupload'=> $this->timeupload,
            'dateupload'=> $this->dateupload
            
        ];
    }
}

