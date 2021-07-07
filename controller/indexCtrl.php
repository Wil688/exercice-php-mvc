<?php

    $clients = new Clients;
    $clientsList = $clients->getAllClients();
    $limitChoiceUsers = 5;
    if (!empty($_POST['limitChoice'])) {
        if ($_POST['limitChoice'] <= 25 &&  $_POST['limitChoice'] >= 5 && $_POST['limitChoice'] % 5 == 0) {
            $limitChoiceUsers = htmlspecialchars($_POST['limitChoice']);
        }
    }
    //$clientsList20 = $clients->get20firstClients();
    $clientsList20 = $clients->getClientsLimitChoice($limitChoiceUsers);
    $clientsInfo = $clients->getAllClientsInfo();
    $clientsName = $clients->getClientsNamesStartByM();
    // avec formulaire
    /* if (!empty($_POST['search'])) {
        $search = htmlspecialchars($_POST['search']);
        $clientsByName = $clients->getClientsByName($search);        
    } else {
        $clientsByName = $clients->getAllClients();
    } */
    $showUsersInfo = $clients->getAllClientsInfo();
    if(!empty($_POST['addUser'])){
        if(isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['birthDate']) && isset($_POST['radioCard'])){
            $addNewClients = $clients->addClients();
        }
        if (!empty($_POST['deletClient'])) {
            $deleteClientID = $clients->deleteClient();
        }
    }
    $showClientID = $clients->showIdClient();
    
    $shows = new Shows;
    $showsList = $shows->getAllShowTypes();
    $showInfo = $shows->getShowsInfo();

    $clientsCards = new Cards;
    $clientsCardsList = $clientsCards->showClientsCards();
?>