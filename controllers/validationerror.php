<?php
session_start();
class validationerr extends ValidateRule{
    public function FetchErr()
    {
        $_SESSION['errors'] = $this->errors;
        header('LOCATION:'.$_SERVER['HTTP_REFERER']);
 
    }
    public function checkError()
    {
        # code...
        if(count($this->errors)>0){
            $this->FetchErr();
        } else{
            return true;
        }
    }
    
}
?>