<?php 
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
    }
}