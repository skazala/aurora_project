<?php
class DeleteController extends Controller {

    private $id;

    public function __construct($id) 
    {
        $this->id = $id;
    }
    public function go() {
        
        Item::deleteItem($this->id);
        
        $this->addMessage('This item was successfully removed!');
        $this->redirect('aurora/');
    }
}