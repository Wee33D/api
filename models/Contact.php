<?php

declare(strict_types=1);

class Contact 
{
    public $name;
    public $phonenum;
    public $email;

    public function JsonSerializable()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phonenum' => $this->phonenum,
            'email' => $this->email,
        ];
    }
}

