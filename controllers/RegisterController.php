<?php
class RegisterController extends Controller {

    public function go() {
        
        $this->data['title'] = 'Let\'s add a new user!';

        // Was 'LOGOUT' button pressed?
        if(isset($_POST['logout'])) {
            unset($_SESSION['user']);
        }

        // Was 'GO' button pressed?
        if(isset($_POST['authentification'])) {
            $auth = new AuthController($_POST['login'], $_POST['password']);
            $auth->go();
        }

        // Was the 'add a new user' button pressed?
        if(isset($_POST['addeditbutton'])) {
            $this->data['login'] = $_POST['login'];
            $this->data['password'] = $_POST['password'];
            $this->data['password_repeat'] = $_POST['password_repeat'];
            
            // Grabbing the data
            $login = $_POST['login'];
            $password = $_POST['password'];
            $password_repeat = $_POST['password_repeat'];
    
            // Running error handlers and user registration
            $errors = $this->getUserErrors($login, $password, $password_repeat);
            if ($errors) {
                foreach ($errors as $e) {
                    $this->addMessage($e);    
                }
            } else {
                $user = User::getUserByLogin($login);
                if($user) {
                    $this->addMessage('User with this login already exists!');
                    $this->redirect('aurora/register');
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $user = new User($login, $hashed_password);
                    $user->setUser();
                    
                    $this->addMessage('New user was succesfully registered!');
                    $this->redirect('aurora/');
                }
            }
        } else { 
            // form was not submitted, display empty form
            $this->data['login'] = '';
            $this->data['password'] = '';
            $this->data['password_repeat'] = '';
        }
        
        $this->data['user'] = $_SESSION['user'] ?? '';
        $this->data['messages'] = $this->getMessages();
        $this->data['header'] = 'Add a new user here:';
        $this->view = 'register';
        
    }

    private function getUserErrors($login, $password, $password_repeat) {
        $errors = [];
        //login
        if($this->isBlank($login)) {
            $errors[] = "Login cannot be blank.";
        } elseif(!$this->hasLength($login, ['min' => 4, 'max' => 25])) {
            $errors[] = "Login must be between 4 and 25 characters.";
        }
        //password
        if($this->isBlank($password)) {
            $errors[] = "Password cannot be blank.";
        } elseif(!$this->hasLength($password, ['min' => 6, 'max' => 50])) {
            $errors[] = "Password must be between 6 and 50 characters.";
        }
        //password_repeat  
        if($password !== $password_repeat) {
            $errors[] = "Password does not match.";
        }  
        return $errors;       
    }
}