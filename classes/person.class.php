<?php
class Person {

    //Properties
    private $id;
    private $firstName;
    private $lastName;
    private $number;
    private $company;
    private $image;

    //Method
    public function __construct($id, $firstName, $lastName, $number, $company, $image) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->number = $number;
        $this->company = $company;
        $this->image = $image;
    }
//Getter method allows you to retrieve the values of the private properties outside the class
//Setter method allows you to update the values of the private properties from outside the class 
    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getNumber() {
        return $this->number;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function getCompany() {
        return $this->company;
    }

    public function setCompany($company) {
        $this->company = $company;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
}