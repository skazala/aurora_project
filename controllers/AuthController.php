<?php
class AuthController extends Controller {

    private $login;
    private $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }
    
    public function go() {

        $errors = [];
        //login check
        if($this->isBlank($_POST['login'])) {
            $errors[] = "Please enter your login to sign in";
        }
        //password check
        if($this->isBlank($_POST['password'])) {
            $errors[] = "Please enter your password to sign in";
        }

        if ($errors) {
            foreach ($errors as $e) {
                $this->addMessage($e);    
            }    
        } else{
            $user = User::getUserByLogin($this->login);
            if(!$user) {
                $this->addMessage('There is no such user!');
            } else {
                if(password_verify($this->password, $user['hashed_password'])) {
                    $_SESSION['user'] = $user['login'];
                } else {
                    $this->addMessage('Ooooops! Wrong password');
                }
            }
        }
    }
}