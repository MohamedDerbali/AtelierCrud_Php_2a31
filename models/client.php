<?php
class client{
    private int $idClient ;
    private string $lastName;
    private string $firstName;
    private string $address;
    private \DateTime $dob;

    public function getIdC (){
        return $this->idClient;
    }
    public function getLastNameC (){
        return $this->lastName;
    }
    public function getFirstNameC (){
        return $this->firstName;
    }
    public function getAddressC (){
        return $this->address;
    }
    public function getDobC (){
        return $this->dob;
    }
    public function __construct(string $firstName='',string $lastName='',string $address='',\DateTime $dob=new DateTime("now")){
        $this->lastName=$lastName;
        $this->firstName=$firstName;
        $this->address=$address;
        $this->dob=$dob;
    }
}
