<?php 

class Model_Mapper_Film
{
    private $filmTable;
    
    // pour la recuperation de la liste des films
    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
        $result = $this->getFilmTable()->fetchAll($where, $order, $count, $offset);
        if (0 === $result->count()) {
            return false;
        }
        $film = array();
        foreach ($result as $row) {
            $films[] = $this->rowToObject($row);
        }
        return $films;
    }
    
    // méthode pour trouver un film et l'afficher à l'ecran
    public function find($filmId)
    {
        $result = $this->getFilmTable()->find($filmId);

        if($result->count() === 0) { // methode de zend qui permet de compter le nombre de résultats trouvé
            return false;
        }
        // charge la méthode qui trouve le film et en meme temps la retourne (simplification du code)
        return $this->rowToObject($result[0]);
    }
    
    // pour creer (inserer) un nouveau film
    public function insert(Model_Film $film)
    {
        // transformer l'objet en données inserable
        // on charge la méthode qui retourn l'objet
        $data = $this->objectToRow($film);
        return $this->getFilmTable()->insert($data);
    }
    
    // pour cmettre à jour une fiche de film
    public function update(Model_Film $film)
    {
        $data = $this->objectToRow($film);
        $where = array('film_id = ?' => $film->getFilmId());
        return $this->getFilmTable()->update($data, $where);
    }
    
    // Méthode qui traite l'objet
    public function objectToRow(Model_Film $film)
    {
        return array(
            'film_id' => $film->getFilmId(),
            'title' => $film->getTitle(),
            'description' => $film->getDescription(),
            'release_year' => $film->getReleaseYear(),
            'language_id' => $film->getLanguageId(),
            'original_language_id' => $film->getOriginalLanguageId(),
            'rental_duration' => $film->getRentalDuration(),
            'rental_rate' => $film->getRentalRate(),
            'length' => $film->setLength(),
            'replacement_cost' => $film->getReplacementCost(),
            'rating' => $film->getRating(),
            'special_features' => $film->getSpecialFeatures(),
            'last_update' => $film->getLastUpdate()
        );
        $where = array('film_id = ?' => $film->getFilmId());
        return $this->getFilmTable()->update($data, $where);
    }
    
    // Méthode qui traite les lignes
    public function rowToObject($data)
    {
        $film = new Model_Film;
        $film->setFilmId($data['film_id'])
             ->setTitle($data['title'])
             ->setDescription($data['description'])
             ->setReleaseYear($data['release_year'])
             ->setLanguageId($data['language_id'])
             ->setOriginalLanguageId($data['original_language_id'])
             ->setRentalDuration($data['rental_duration'])
             ->setRentalRate($data['rental_rate'])
             ->setLength($data['length'])
             ->setReplacementCost($data['replacement_cost'])
             ->setRating($data['rating'])
             ->setSpecialFeatures($data['special_features'])
             ->setLastUpdate($data['last_update']);
        return $film;
    }
    
    // méthode qui permet de vérifier si une instance de $table existe déjà, si c'est le cas il l'utilise mais n'en cree pas une autre
    private function getFilmTable()
    {
        if (null === $this->filmTable){
            $this->filmTable = new Model_DbTable_Film;
        }
        return $this->filmTable;
    }
}