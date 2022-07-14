<?php
abstract class Controller {

    protected $data = array();
    protected $view = "";

    abstract function go();

    public function renderView() {
        if ($this->view) {
            extract($this->protect($this->data));// transforms array indexes into variables e.g. $title and $description
            extract($this->data, EXTR_PREFIX_ALL, "");
            require('views/' . $this->view . '.phtml');
        }
    }

    public function redirect($url) {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }

    private function protect($x = null) {
        if (!isset($x))
            return null;
        elseif (is_string($x)) 
            return htmlspecialchars($x, ENT_QUOTES);
        elseif(is_array($x)) {
            foreach ($x as $key => $value) {
                $x[$key] = $this->protect($value);
            }
            return $x;
        }
        else
            return $x;
    }

    public function addMessage($message) {
        if (isset($_SESSION['messages']))
            $_SESSION['messages'][] = $message;
        else
            $_SESSION['messages'] = array($message);
    }

    public function getMessages() {
        if (isset($_SESSION['messages'])) {
            $messages = $_SESSION['messages'];
            unset($_SESSION['messages']);
            return $messages;
        }
        else
            return array();
    }

    // Error hadlers here
    protected function isBlank($value) {
        return !isset($value) || trim($value) === '';
    }

    protected function hasLengthGreaterThan($value, $min) {
        $length = strlen(trim($value));
        return $length > $min;
    }
    
    protected function hasLengthLessThan($value, $max) {
        $length = strlen($value);
        return $length < $max;
    }
    
    protected function hasLength($value, $options) {
        if(isset($options['min']) && !$this->hasLengthGreaterThan($value, $options['min'] - 1)) {
          return false;
        } elseif(isset($options['max']) && !$this->hasLengthLessThan($value, $options['max'] + 1)) {
          return false;
        } else {
          return true;
        }
    }

    protected function getItemErrors($name, $description, $status) {
        $errors = [];
        //name
        if($this->isBlank($name)) {
            $errors[] = "Name cannot be blank.";
          } elseif(!$this->hasLength($name, ['min' => 2, 'max' => 50])) {
            $errors[] = "Name must be between 2 and 50 characters.";
          }
        //description
        if($this->isBlank($description)) {
            $errors[] = "Description cannot be blank.";
          } elseif(!$this->hasLength($description, ['min' => 2, 'max' => 255])) {
            $errors[] = "Description must be between 2 and 255 characters.";
          }  
        //status
        if($this->isBlank($status)) {
            $errors[] = "Status cannot be blank.";
          }
 
        return $errors;
    }

}