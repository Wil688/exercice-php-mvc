<?php

require 'class/db.php';
require 'model/clients.php';
require 'model/shows.php';
require 'model/cards.php';
require 'controller/indexCtrl.php';
//var_dump($showsList)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Colyseum</title>
</head>

<body>
    
    <h1>exo1</h1>
    <p>Afficher tous les clients.</p>
    <table>

        <tr>
            <th>id</th>
            <th>Nom</th>
            <th>Prénom</th>
        </tr>
        <?php foreach ($clientsList20 as $key => $value) { // pour parcourir mon tableau d'informations transformer en objet
        ?>
            <tr>
                <td><?= $value->id ?><br></td>
                <td><?= $value->lastName ?><br></td>
                <td><?= $value->firstName ?><br></td>
            </tr>
        <?php } ?>
    </table>
    <h2>exo2</h2>
    <p>Afficher tous les types de spectacles possibles.</p>
    <table>
        <select name="" id="">
            <?php foreach ($showsList as $key => $value) { ?>
                <option value="<?= $value->$key ?>"><?= $value->type ?></option>
            <?php } ?>
        </select>
    </table>
    <h2>exo3</h2>
    <p>Afficher les <?= $limitChoiceUsers ?> premiers clients.</p>
    <table>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénom</th>
        </tr>
        <form action="index.php" method="POST" name="limitChoiceForm">
            <select name="limitChoice" id="" onchange="document.forms['limitChoiceForm'].submit()">
                <?php for ($limitChoice = 5; $limitChoice <= 25; $limitChoice += 5) { ?>
                    <option value="<?= $limitChoice ?>" <?= (isset($_POST['limitChoice']) && $_POST['limitChoice'] == $limitChoice) ? 'selected' : '' ?>><?= $limitChoice ?></option>
                <?php } ?>
            </select>
        </form>
        <?php foreach ($clientsList20 as $key => $value) { ?>
            <tr>
                <td><?= $value->id ?><br></td>
                <td><?= $value->lastName ?><br></td>
                <td><?= $value->firstName ?><br></td>
            </tr>
        <?php } ?>
    </table>
    </table>
    <h2>exo4</h2>
    <p>N'afficher que les clients possédant une carte de fidélité.</p>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
        </tr>
        <?php foreach ($clientsCardsList as $key => $value) { ?>
            <tr>
                <td><?= $value->lastName ?><br></td>
                <td><?= $value->firstName ?><br></td>
            </tr>
        <?php } ?>
    </table>
    <h2>exo5</h2>
    <p>Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M".
        Les afficher comme ceci : <br>Nom : Nom du client <br>Prénom : Prénom du client <br>Trier les noms par ordre alphabétique.</p>
    <?php foreach ($clientsName as $key => $value) { ?>
        <p><b>Nom :</b><?= $value->lastName ?></p>
        <p><b>Prénom :</b> <?= $value->firstName ?></p>
    <?php } ?>

    <h2>exo6</h2>
    <p>Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. Trier les titres par ordre alphabétique. Afficher les résultat comme ceci : Spectacle par artiste, le date à heure.</p>
    <?php foreach ($showInfo as $key => $value) { ?>
        <p>Spectacle <?= $value->title ?> par <?= $value->performer ?>, le <?= $value->date ?> à <?= $value->startTime ?>.</p>
    <?php } ?>
    <h2>exo7</h2>
    <p>Afficher tous les clients comme ceci : <br>
        Nom : Nom de famille du client <br>
        Prénom : Prénom du client <br>
        Date de naissance : Date de naissance du client<br>
        Carte de fidélité : Oui (Si le client en possède une) ou Non (s'il n'en possède pas)<br>
        Numéro de carte : Numéro de la carte fidélité du client s'il en possède une.</p>
    <div class="container-fluid">
        <div class="row">
            <?php foreach ($showUsersInfo as $key => $value) { ?>
                <div class="card offset-1" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Client n°<?= $value->id ?></h5>
                        <p>Nom : <?= $value->lastName ?></p><br>
                        <p>Prénom : <?= $value->firstName ?></p><br>
                        <p>Date de naissance : <?= $value->birthDate ?></p><br>
                        <p>Carte de fidélité : <?= $value->cardFid ?></p><br>
                        <p>Numéro de carte : <?= $value->cardNumber ?></p><br>
                    </div>
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Afficher le profil
                        </button> -->
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <?php foreach (array($showClientID) as $value){ ?>
                                        <h5 class="modal-title" id="exampleModalLabel">Client n°<?= $value->id ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <p>Nom : <?= $value->lastName ?></p><br>
                                    <p>Prénom : <?= $value->firstName ?></p><br>
                                    <p>Date de naissance : <?= $value->birthDate ?></p><br>
                                    <p>Carte de fidélité : <?= $value->card ?></p><br>
                                    <p>Numéro de carte : <?= $value->cardNumber ?></p><br>
                                    <?php } ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <form action="index.php" method="post">
                            <input type="submit"  class="btn btn-danger" value="Supprimer" name="deleteClient">
                        </form> -->
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <h2>Exo bonus : Ajouter un client</h2>
    <div class="container">
        <form action="index.php" class="row form-check" method="POST">
            <div class="mb-3">
                <label for="formFile" class="form-label">Nom :</label>
                <input class="form-control" type="text" id="formFile" name="lastName">
            </div>
            <div class="mb-3">
                <label for="formFileMultiple" class="form-label">Prénom :</label>
                <input class="form-control" type="text" id="formFileMultiple" multiple name="firstName">
            </div>
            <div class="mb-3">
                <label for="formFileDisabled" class="form-label">Date de naissance :</label>
                <input class="form-control" type="date" id="formFileDisabled" name="birthDate">
            </div>
            <div class="form-check">
                <p>Souhaitez vous bénéficier d'une carte de membre :</p>
                <input class="form-check-input" type="radio" name="radioCard" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Oui
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radioCard" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    Non
                </label>
            </div>
            <input type="submit" value="S'inscrire" name="addUser">
        </form>
    </div>
</body>

</html>