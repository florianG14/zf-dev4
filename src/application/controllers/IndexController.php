<?php 
// Controller => toujours léger
// a documenter ici
class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        /*$film = new Model_Film;
        var_dump($film);*/
        /*try {
            $filmMapper = new Model_Mapper_Film();
            var_dump($filmMapper->find(1));
        } catch (Exception $e) {
            echo $e->getMessage();
        }*/
        //echo 'coucou';
        
        /*$filmMapper = new Model_Mapper_Film();
        $this->view->film = $filmMapper->find(1);*/
        
        // Service ou API
        $filmApi = new Service_Film;
        //$this->view->film = $filmApi->find(1);
        
        $this->view->film = $filmApi->getList(null,'last_update DESC',10); // pas obligé d'ajouter les param d'apres, sous entendu à NULL
        // on peut donc aussi ajotuer un ordre grace à => last_update DESC
        
        // on affiche les acteur
        $actorApi = new Service_Actor;
        $this->view->actor = $actorApi->getList(null,'last_update DESC',10);
    }
    
    // pour les acteurs
    public function actorAction()
    {
        $actorId = (int) $this->getRequest()->getParam('actor_id');
        $actorApi = new Service_Actor;
        $this->view->actor = $actorApi->find($actorId, $filmId);
        if (!$this->view->actor) {
            // on assigne un message à afficher lorsque l'on va avoir ce type d'erreur
            throw new Zend_Controller_Action_Exception('Acteur inexistant', 404);
        }
    }
    
    public function filmAction()
    {
        $filmId = (int) $this->getRequest()->getParam('filmid');
        $filmApi = new Service_Film;
        $this->view->film = $filmApi->find($filmId);
        if (!$this->view->film) {
            // on assigne un message à afficher lorsque l'on va avoir ce type d'erreur
            throw new Zend_Controller_Action_Exception('Film inexistant', 404);
        }
    }
    
    // Effacer un film
    public function deleteAction()
    {
        $filmId = (int) $this->getRequest()->getParam('filmid');
        $filmApi = new Service_Film;
        $filmApi->delete($filmId);
        $this->_redirect('/'); // on renvoi sur l'index apres l'effacement
    }
}