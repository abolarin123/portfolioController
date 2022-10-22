<?php 
// validation rule 
class ValidateRule{
    public $data;// the post request array
    public $DB;// con driver
    public $errors =[];// all validation errors go here
    //a construct is the first function triggered once the instance of the class is created
    public function __construct( $data ,$DB)
    {
        # code...
        $this->data = $data;
        $this->DB=$DB;
    }
    function testimput($input){
        $value= trim($input);//takes out whitespaces 
        $value = stripslashes($value);// takes out foward slashes and back slashes
       $value= htmlspecialchars($value);//converts special characters to html
       $value = $this->DB->real_escape_string($value);

       return $value;
         
    } 
    public function isEmpty($input,$title)
    {
        if (empty($input)){
         $this->addError($title,'This field cannot be empty.') ;  
         return true;
        }
        return $input;
    }
   public function isValidEmail($value,$title) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)){
                $this->addError($title,"Invalid Email Format.");
        }
       return $value;
    }
    function input_length($input, $field)
    {
        # code...
        if (strlen($input) <3) {
            # code...
            $this->addError($field, "field has too few characters. This field must be atleast greater than 2 characters.");
        }
       return $input;
    }
    function valid_password($input, $field){
        $uppercase      = preg_match('@[A-Z]@', $input);
        $lowercase      = preg_match('@[a-z]@', $input);
        $number         = preg_match('@[0-9]@', $input);
        $specialChars   = preg_match('@[^\w]@', $input);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($input) < 6) {
            $this->addError($field, 'Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.');
        }
        return $input;
    }

    public function addError($key, $value)
    {
       $this->errors[$key] = $value ;
    }
    
}

?>