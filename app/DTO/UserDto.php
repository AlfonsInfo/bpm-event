<?php

namespace App\DTO;
class UserDTO{
    public function __construct(
                                  string $name, 
                                  string $email, 
                                  string $password
    ){
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}