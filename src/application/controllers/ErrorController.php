<?php 

class ErrorController extends Zend_Controller_Action
{
    // permet d'intercepter une erreur et de l'afficher dans le network de la console (ex : 404)
    public function errorAction()
    {
        $errorHandler = $this->_getParam('error_handler');
        // var_dump($errorHandler);
        $exception = $errorHandler->exception;
        if ($exception->getCode() == 404) {
            $this->getResponse()->setHttpResponseCode(404);
        }
        
        $this->view->message = $exception->getMessage();
        $this->view->code = $exception->getCode();
    }
}