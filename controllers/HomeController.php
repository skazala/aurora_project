<?php
class HomeController extends Controller {

    public function go() {
        
        $this->data['title'] = 'Welcome to the aricle manager!';
        
        // Was the form submitted?
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Was 'DELETE' button pressed?
            if(isset($_POST['delete'])) {
                $delete = new DeleteController($_POST['delete']);
                $delete->go();
            }
                            
            // Was 'EDIT' button pressed?
            if(isset($_POST['edit']))
                $this->redirect('aurora/edit?id=' . $_POST['edit']);

            // Was 'GO' button pressed?
            if(isset($_POST['authentification'])) {
                $auth = new AuthController($_POST['login'], $_POST['password']);
                $auth->go();
            }

            // Was 'LOGOUT' button pressed?
            if(isset($_POST['logout'])) {
                unset($_SESSION['user']);
            }

        }
        $this->data['user'] = $_SESSION['user'] ?? '';
        $this->data['items'] = Item::getAllItems();
        $this->view = 'home';

    }
}