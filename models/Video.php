<?php

declare(strict_types=1);

class Video {
    public $sendername;
    public $videourl;
    public $timendateupload;
    


    public function JsonSerializable(){
    
        return [
            'id' => $this->id,
            'sendername'=> $this->sendername,
            'videourl'=> $this->videourl,
            'timendateupload'=> $this->timendateupload
           
            
        ];
    }
}

