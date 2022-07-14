<?php
class RouterController extends Controller {

    protected $controller;

    public function go() {
        $parsedUrl = $this->parseUrl($_SERVER['REQUEST_URI']);
        // preventing from opening pages that doesn't exist
        if($parsedUrl[0] == 'delete' || ($parsedUrl[0] == 'edit' && !isset($_GET['id']))) {
            $this->redirect('aurora/');
        }

        if (empty($parsedUrl[0]) || $parsedUrl[0] == 'index') {
            $controllerClass = 'HomeController';
        } else {
            $controllerClass = $this->getControllerName(array_shift($parsedUrl) . 'Controller');
        }
        
        $this->data['user'] = isset($_SESSION['user']) ? $_SESSION['user'] : '';

        $this->controller = new $controllerClass;
        $this->controller->go();

        // Sets the main template
        $this->view = 'layout';

        // passes data to the template
        $this->data['user'] = $this->controller->data['user'];
        $this->data['messages'] = $this->getMessages();
        $this->data['title'] = $this->controller->data['title'];
    }

    private function parseUrl($url) {
        $parsedUrl = parse_url($url);
        $parsedUrl['path'] = ltrim($parsedUrl['path'], '/');
        $parsedUrl['path'] = trim($parsedUrl['path']);

        $explodedUrl = explode('/', $parsedUrl['path']);
        array_shift($explodedUrl); //removes the project folder's name e.g. aurora
        $explodedUrl = str_replace('.php', '', $explodedUrl);
        // print_r ($explodedUrl);
        return $explodedUrl;
    }

    private function getControllerName($text) {
        $text = str_replace('-', ' ', $text);
        $text = ucwords($text);
        $text = str_replace(' ', '', $text);
        return $text;
    }

}