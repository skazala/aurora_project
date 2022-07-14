<?php
class EditController extends Controller {

    public function go() {
        
        $this->data['title'] = 'Let\'s edit this item!';

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
    
            // Running error handlers and item updating
            $errors = $this->getItemErrors($name, $description, $status);
            if ($errors) {
                foreach ($errors as $e) {
                    $this->addMessage($e);    
                }
            } else {
                $id = $_GET['id'];
                $item = new Item($name, $description, $status, $category);
                $item->updateItem($id);
                
                $this->addMessage('This item was successfully updated!');
                $this->redirect('aurora/');
            }
        } else { 
            // form was not submitted, display form with data for editing
            $id = $_GET['id'];
            $item = Item::getItemById($id);
            $this->data['name'] = $item['name'];
            $this->data['description'] = $item['description'];
            $this->data['status'] = $item['status'];
            $this->data['category'] = $item['category'] ?? '';
        }
        
        $this->data['user'] = $_SESSION['user'] ?? '';
        $this->data['messages'] = $this->getMessages();
        $this->data['categories'] = Category::getAllCategories();
        $this->data['header'] = 'Edit an item here:';
        $this->data['button'] = 'Update an item';
        $this->view = 'addedit';

    }
}