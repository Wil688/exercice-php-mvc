<?php 
    class Shows {
        private $id = 0;
        private $type = '';

        private $dbShowTypes = NULL;

        // 'public /private /protected' + 'function() {}' = éq. une fontion en POO
        public function __construct()
        {
            $showtypes = new Db;
            $this->dbShowTypes = $showtypes->connect();

        }
        public function getAllShowTypes()
        {   
            //resultat exo2
            $resultat = $this->dbShowTypes->query('SELECT id,`type` FROM showtypes');
            $showtypes = $resultat->fetchAll(PDO::FETCH_OBJ);
            return $showtypes;
        }
        public function getShowsInfo()
        {   
            //resultat exo6
            $exo6 = $this->dbShowTypes->query('SELECT shows.title,shows.performer,shows.date,shows.startTime FROM shows ORDER BY title ASC');
            $showInfo = $exo6->fetchAll(PDO::FETCH_OBJ);
            return $showInfo;
        }
        
        
    }
?>