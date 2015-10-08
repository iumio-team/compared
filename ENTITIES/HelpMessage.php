<?php

use LayerConnector\MDA;

class HelpMessage implements Omium
{
   
    private $id,$name,$email,$subject,$content,$date;
    
    public function __construct($args) {
         switch($args){
            case is_array($args):
                $this->name = $args['name'];
                $this->email = $args['email'];
                $this->subject = $args['subject'];
                $this->content = $args['content'];
                $this->date= $args['date'];
                break;
            default :
                $this->id = $args;
                
                
         }
    }
    

    public function getId() {
        return $this->id;
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function getDate() {
        return $this->getDate();
    }
    public function getEmail() {
        return $this->email;
    }
    
    public function getSubject() {
        return $this->subject;
    }
    
    public function getName() {
        return $this->name;
    }
    public function create() {
        $count = MDA::insertHelpMessage($this->name,  $this->email,  $this->subject,  $this->content,$this->date)->rowCount();
        return $count;
        
    }
    
    public function delete() {
        $count = MDA::deleteAllById('HelpMessage', $this->id,'id')->rowCount();
         return $count;
    }
    public function update() {
        $count = MDA::updateHelpMessage($this->id, $this->name, $this->email, $this->subject, $this->content,$this->date)->rowCount();
        return $count;
    }

    public function getItem() {
        $result = MDA::findAllById('HelpMessage',$this->id ,'id')->fetch();
        $this->name = $result['name'];
        $this->email = $result['email'];
        $this->object = $result['subject'];
        $this->content = $result['content'];
        $this->date = $result['date'];
        
    }

}
