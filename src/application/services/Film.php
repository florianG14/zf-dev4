<?php 

class Service_Film
{
    private $filmMapper = null;
    
    // créer un film
    public function create(Model_Film $film)
    {
        // j'instancie mon mapper
        return $this->getFilmMapper()->insert($film);
    }
    
    // chercher et afficher un film
    public function find($filmId)
    {
        /*$filmMapper = new Model_Mapper_Film;
        return $filmMapper->find($filmId);*/
        return $this->getFilmMapper()->find($filmId);
    }
    
    public function delete($filmId)
    {
        // attaque directement la tabel film en instanciant le DBTABLe 
        /*$filmTable = new Model_DbTable_Film;
        return $filmTable->delete($filmId);*/
        return $this->getFilmMapper()->delete($filmId);
    }
    
    // on met a jour des elements de l'objet film , pour un film en particulier donc on ne fait pas passer un id film mais un model
    public function update(Model_Film $film)
    {
        return $this->getFilmMapper()->update($film);
    }
    
    // affiche la liste des films
    public function getList($where = null, $order = null, $count = null, $offset = null)
    {
        return $this->getFilmMapper()->fetchAll($where, $order, $count, $offset);
    }
    
    /**
     * Lazy loading du mapper film
     */
    // sert a verifier si une instance de mapper existe deja, et en creer un nouveau s'il n'existe pas
    private function getFilmMapper()
    {
        if (null === $this->filmMapper){
            $this->filmMapper = new Model_Mapper_Film;
        }
        return $this->filmMapper;
    }
}