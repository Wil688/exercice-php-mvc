<?php 
    class Cards{
        private $id = 0;
        private $cardNumber = 0;
        private $cardTypeId = 0;
        private $lastName = '';
        private $firstName = '';

        private $clientsCardsTypes = NULL;

        public function __construct()
        {
            $showCardsTypes = new Db;
            $this->clientsCardsTypes = $showCardsTypes->connect();

        }
        public function showClientsCards()
        {
            $result = $this->clientsCardsTypes->query('SELECT clients.lastName,clients.firstName
            FROM clients
                INNER JOIN cards ON cards.cardNumber = clients.cardNumber
                INNER JOIN cardtypes ON cardtypes.id = cards.cardTypesId
            WHERE cardtypes.type = \'Fidélité\'');
            // autre syntaxe plus simple
            /* $result = $this->clientsCardsTypes->query('SELECT clients.lastName,clients.firstName
            FROM clients
                INNER JOIN cards ON cards.cardNumber = clients.cardNumber
            WHERE `card` = 1 AND cards.cardtypes = 1'); */
            $clientsCards = $result->fetchAll(PDO::FETCH_OBJ);
            return $clientsCards;
        }
        /* public function addClientsCards(){
            $result = $this->clientsCardsTypes->query('')
        } */
    }
    

?>