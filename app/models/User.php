<?php

namespace App\Models;

class User
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $phone;
    private $avatar;
    private $gender;
    private $address;

    public function __construct($id, $firstname, $lastname, $email, $phone, $avatar, $gender, $address)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->avatar = $avatar;
        $this->gender = $gender;
        $this->address = $address;
    }

    public function getId() {
        return $this->id;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getAddress() {
        return $this->address;
    }
}
