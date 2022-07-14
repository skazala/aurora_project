<?php
class ItemController extends Controller {

    public function process($params) {

    }

    // Error hadlers here
    private function isBlank($value) {
        return !isset($value) || trim($value) === '';
    }

    private function hasLengthGreaterThan($value, $min) {
        $length = strlen(trim($value));
        return $length > $min;
    }
    
    private function hasLengthLessThan($value, $max) {
        $length = strlen($value);
        return $length < $max;
    }
    
    private function hasLength($value, $options) {
        if(isset($options['min']) && !$this->hasLengthGreaterThan($value, $options['min'] - 1)) {
          return false;
        } elseif(isset($options['max']) && !$this->hasLengthLessThan($value, $options['max'] + 1)) {
          return false;
        } else {
          return true;
        }
    }

    private function getErrors($name, $description, $status) {
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