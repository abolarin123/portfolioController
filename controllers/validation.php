<?php

class validateinput extends  validationerr{
    public static $fields=[];
    public function validateFunc()
    {
       // print_r($this->data);

       self::$fields= array_keys($this->data);
       foreach(self::$fields as $field)
       {
        if ($field == 'sign_up'){
            continue;
        }
        if ($field == 'sign_in'){
            continue;
        }
        $value= $this->testimput($this->data[$field]);
        $value = $this->isEmpty($value, $field);   
        if($field == 'email') {
            $value = $this->isEmpty($value, $field);
            $value = $this->isValidEmail($value, $field);
        }
        if($field == 'password'){
            $value = $this->valid_password($value, $field);
        }          
       }
        
    }
}
?>