<?php
require_once "../models/config.php";
class clientC{
    public function addClient($client){
        try {
            $sql = "INSERT INTO client (lastName, firstName, address, dob) VALUES (:lastName, :firstName, :address, :dob)";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('lastName', $client->getLastNameC());
            $query->bindValue('firstName', $client->getFirstNameC());
            $query->bindValue('address', $client->getAddressC());
            $query->bindValue('dob', $client->getDobC()->format('Y-m-d'));
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function displayClients(){
        try {
            $sql = "SELECT * from client";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function deleteClient(int $idClient){
        try {
            $sql = "DELETE from client where idClient = ?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idClient);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function getClientById($idClient){
        try {
            $sql = "SELECT * from client where idClient=?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idClient);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function updateClient($idclient, $client){
        try {
            $sql = "UPDATE client SET firstName = :firstName, lastName = :lastName,address = :address, dob = :dob WHERE idClient = :idClient";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('lastName', $client->getLastNameC());
            $query->bindValue('firstName', $client->getFirstNameC());
            $query->bindValue('address', $client->getAddressC());
            $query->bindValue('dob', $client->getDobC()->format('Y-m-d'));
            $query->bindValue(':idClient', $idclient);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function sortClients(){}
}
