<?php
class AddController extends Controller {

    public function go() {
        if(!isset($_SESSION['user'])) {
            $this->addMessage('Only logged users can add items!');
            $this->redirect('aurora/');
        }

        $this->data['title'] = 'Let\'s add a new item!';

        // Was the form submitted?
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Was 'LOGOUT' button pressed?
            if(isset($_POST['logout'])) {
                unset($_SESSION['user']);
                $this->redirect('aurora/');
            }

            $this->data['name'] = $_POST['name'];
            $this->data['description'] = $_POST['description'];
            $this->data['status'] = $_POST['status'];
            $this->data['category'] = $_POST['category'] ?? '';
            
            // Grabbing the data
            $name = $_POST['name'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $category = $_POST['category'] ?? '';
    
            // Running error handlers and item inserting
            $errors = $this->getItemErrors($name, $description, $status);
            if ($errors) {
                foreach ($errors as $e) {
                    $this->addMessage($e);    
                }
            } else {
                $item = new Item($name, $description, $status, $category);
                $item->setItem();
                
                $this->addMessage('Adding an item was successful!');
                $this->redirect('aurora/');
            }
        } else { 
            // form was not submitted, displays empty form
            $this->data['name'] = '';
            $this->data['description'] = '';
            $this->data['status'] = '';
            $this->data['category'] = '';
        }
        
        $this->data['user'] = $_SESSION['user'] ?? '';
        $this->data['messages'] = $this->getMessages();
        $this->data['categories'] = Category::getAllCategories();
        $this->data['header'] = 'Add a new item here:';
        $this->data['button'] = 'Add a new item';
        $this->view = 'addedit';
        
    }
}