<?php
require "../controllers/clientC.php";
require "../models/client.php";
$clientC = new clientC();
$listClients = $clientC->displayClients();
$updateClient = NULL;

if(isset($_GET["removeClient"])&&!empty($_GET["removeClient"])){
    $clientC->deleteClient($_GET["removeClient"]);
    header('location: http://localhost/atelier_crud_2a31/views/index.php');
}

if(isset($_POST)&&!empty($_POST)){
    if(isset($_GET["updateClient"])&&!empty($_GET["updateClient"])){
        $client = new client($_POST["firstName"], $_POST["lastName"], $_POST["address"], new \DateTime($_POST["dob"]));
        $clientC->updateClient($_GET["updateClient"], $client);
    }
    else{
        $client = new client($_POST["firstName"], $_POST["lastName"], $_POST["address"], new \DateTime($_POST["dob"]));
        $clientC->addClient($client);
    }  
    header('location: http://localhost/atelier_crud_2a31/views/index.php');
}

if(isset($_GET["updateClient"])&&!empty($_GET["updateClient"])){
    $updateClient = $clientC->getClientById($_GET["updateClient"]);    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .removeBtn{
            background-color: red;
            color:white;
        }
        .updateBtn{
            background-color: green;
            color:white;
        }
    </style>
</head>

<body>
    <h1 style="text-align:center">Atelier CRUD PHP</h1>
    <h1>Ajouter un client</h1>
    <form method="POST" action="index.php<?= ($updateClient !== NULL)? "?updateClient=".$updateClient["idClient"]: ""; ?>">
    lastName:<input type="text" value="<?= ($updateClient !== NULL)? $updateClient["lastName"]: ""; ?>" name="lastName" placeholder="write your lastName here ..." id=""><br/><br/>
    firstName:<input type="text" value="<?= ($updateClient !== NULL)? $updateClient["firstName"]: ""; ?>" name="firstName" placeholder="write your firstName here ..." id=""><br/><br/>
    address:<input type="text" value="<?= ($updateClient !== NULL)? $updateClient["address"]: ""; ?>" name="address" placeholder="write your address here ..." id=""><br/><br/>
    dob:<input type="date" value="<?= ($updateClient !== NULL)? $updateClient["dob"]: ""; ?>" name="dob" id=""><br/><br/>
    <input type="submit" value="<?= ($updateClient === NULL)?'Ajouter client': 'Update client' ?>"/>
    </form>
    <h1>Liste des clients</h1>
    <table border="1">
        <thead>
            <th>id Client</th>
            <th>lastName</th>
            <th>firstName</th>
            <th>address</th>
            <th>dob</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($listClients); $i++) {
            ?>
                <tr>
                    <td><?= $listClients[$i]["idClient"]; ?></td>
                    <td><?= $listClients[$i]["lastName"]; ?></td>
                    <td><?= $listClients[$i]["firstName"]; ?></td>
                    <td><?= $listClients[$i]["address"]; ?></td>
                    <td><?= $listClients[$i]["dob"]; ?></td>
                    <td><button class="removeBtn" onclick="removeClient(<?= $listClients[$i]['idClient']; ?>)">Supprimer</button>
                    <button class="updateBtn" onclick="updateClient(<?= $listClients[$i]['idClient']; ?>)">Update</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
    const removeClient = (id) => {
        location.href = `http://localhost/atelier_crud_2a31/views/index.php?removeClient=${id}`
    }
    const updateClient = (id) => {
        location.href = `http://localhost/atelier_crud_2a31/views/index.php?updateClient=${id}`
    }
    </script>
</body>

</html>