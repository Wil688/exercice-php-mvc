<?php
    class Clients
    {
        //Tip : On peut instancier les attributs avec des valeurs par défaut (mais ce n'est pas obligatoire !)... 
        // ce qui permet de distinguer plus rapidement leurs types (0 = int ; '' = string, 0000-00-00 = date)
        private $id = 0;
        private $lastName = '';
        private $firstName = '';
        private $birthDate = '0000-00-00';
        private $card = true;
        private $cardNumber = 0000;

        private $dbClients = NULL;

        // 'public /private /protected' + 'function() {}' = éq. une fontion en POO
        public function __construct()
        {
            $db = new Db;
            $this->dbClients = $db->connect();
        }
        public function getAllClients() 
        {
            //exo1
            // $sql = 'SELECT `id`, `lastName`, `firstName`, `birthDate`, `card`, `cardNumber` FROM `clients`';

            // Pour changer les noms en MAJ, on utilise la méthode UPPER + AS
            // Pour changer le format de la date, on utilise la méthode DATE_FORMAT (+ options désirées) + AS
            $sql = 'SELECT `id`, UPPER(`lastName`) AS `lastName`, `firstName`, DATE_FORMAT(`birthDate`, \'%d/%m/%Y\') AS `birthDate`, `card`, `cardNumber` FROM `clients`';

            $result = $this->dbClients->query($sql);    //c'est un PDOStatement qui retourne plusieurs infos
            return $result->fetchAll(PDO::FETCH_OBJ);   //fetchAll() peut prendre des options pour choisir le format dans lequel on récupère les données, soit ici un tableau objet
        }
        public function get20firstClients() 
        {
            //exo3
            $sql = ('SELECT `id`, UPPER(`lastName`) AS `lastName`, `firstName`, DATE_FORMAT(`birthDate`, \'%d/%m/%Y\') AS `birthDate`, `card`, `cardNumber` FROM `clients` LIMIT 20');
            $result = $this->dbClients->query($sql);    //c'est un PDOStatement qui retourne plusieurs infos
            return $result->fetchAll(PDO::FETCH_OBJ);   //fetchAll() peut prendre des options pour choisir le format dans lequel on récupère les données, soit ici un tableau objet

        }
        public function getClientsLimitChoice($limit) 
        {
            $sql = 'SELECT `id`, UPPER(`lastName`) AS `lastName`, `firstName`, DATE_FORMAT(`birthDate`, \'%d/%m/%Y\') AS `birthDate`, `card`, `cardNumber` FROM `clients` LIMIT :limit';
            //: => représente un marqueur nominatif
            $result = $this->dbClients->prepare($sql);//c'est un PDOStatement qui retourne plusieurs infos
            // prepare => prépare la requête sécurisée
            $result->bindValue(':limit', $limit, PDO::PARAM_INT); 
            // bindValue permet de remplacer le marqueur nominatif dans la requête sql par $limit
            $result->execute(); // execute le prepare + bindValue
            return $result->fetchAll(PDO::FETCH_OBJ);   //fetchAll() peut prendre des options pour choisir le format dans lequel on récupère les données, soit ici un tableau objet

        }
        public function getClientsNamesStartByM() 
        {
            //exo5
            $result = $this->dbClients->query('SELECT clients.lastName,clients.firstName FROM clients WHERE lastName LIKE \'M%\' ORDER BY clients.lastName ASC');
            $clientsNameStartByM = $result->fetchAll(PDO::FETCH_OBJ);
            return $clientsNameStartByM;
        }
        /*public function getClientsNamesBySearch() 
         {
            
            $result = $this->dbClients->prepare('SELECT clients.lastName,clients.firstName FROM clients WHERE lastName LIKE :searh ORDER BY clients.lastName ASC');
            $result->bindValue(':search', $search, PDO::PARAM_INT);
            $clientsNameStartByM = $result->fetchAll(PDO::FETCH_OBJ);
            return $clientsNameStartByM;
        } */
        public function getAllClientsInfo() 
        {
            //exo7
            /* $result = $this->dbClients->query('SELECT clients.lastName,clients.firstName,clients.birthDate,clients.card,clients.cardNumber,
            IF(clients.card = \'0\', \'Non\', \'Oui\') AS `cardFid`,clients.cardNumber
            FROM `clients`');
            $showUsersInfo = $result->fetchAll(PDO::FETCH_OBJ);
            return $showUsersInfo; */
            //exo7
            $result = $this->dbClients->query('SELECT clients.id,clients.lastName,clients.firstName,clients.birthDate,clients.card,clients.cardNumber,
            CASE
            WHEN clients.card = \'0\' THEN \'Non\'
            ELSE \'Oui\'
            END AS `cardFid`,clients.cardNumber
            FROM `clients`');
            $showUsersInfo = $result->fetchAll(PDO::FETCH_OBJ);
            return $showUsersInfo;
        }
        public function addClients() 
        {
            
            $lastName = htmlspecialchars($_POST['lastName']);
            $firstName = htmlspecialchars($_POST['firstName']);
            $birthDate = htmlspecialchars($_POST['birthDate']);
            $radioCard = htmlspecialchars($_POST['radioCard']);
            //exo bonus
            $result = $this->dbClients->prepare('INSERT INTO `clients`(`lastName`, `firstName`, `birthDate`, `card`) VALUES (:lastName,:firstName,:birthDate,:cardChoice)');
            $result->bindValue(':lastName', $lastName, PDO::PARAM_STR);
            $result->bindValue(':firstName', $firstName, PDO::PARAM_STR);
            $result->bindValue(':birthDate', $birthDate, PDO::PARAM_STR);
            $result->bindValue(':cardChoice', $radioCard,PDO::PARAM_BOOL);
            return $result->execute();
        }
        public function deleteClient(){
            $selectedID =
            $result = $this->dbClients->prepare('DELETE FROM`clients` WHERE `clients`.id = :idSlected');
            $result->bindValue(':idSelected',$selectedID,PDO::PARAM_INT);
            $delete = $result->fetchAll(PDO::FETCH_OBJ);
            return $delete;
        } 
        public function showIdClient(){
            $result = $this->dbClients->query('SELECT `id`, UPPER(`lastName`) AS `lastName`, `firstName`, DATE_FORMAT(`birthDate`, \'%d/%m/%Y\') AS `birthDate`, `card`, `cardNumber` FROM `clients`');
            $showClientID = $result->fetch(PDO::FETCH_OBJ);
            return $showClientID;
        }

    }
?>
