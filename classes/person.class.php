<?php

class Person {
    //properties
    public $firstname;
    public $lastname;
    public $number;
    public $company;
    public $image;

    //method
    public function __construct($first, $last, $number, $companyname, $image) {
        $this->firstname = $first;
        $this->lastname = $last;
        $this->number = $number;
        $this->company = $companyname;
        $this->image = $image;
    }

    public function getFirstName() {
        return $this->firstname;
    }

    public function getLastName() {
        return $this->lastname;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getCompany() {
        return $this->company;
    }

    public function getImage() {
        return $this->image;
    }
}                              