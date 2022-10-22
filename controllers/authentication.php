<?php 
//print($_POST['username']);
include('validaterule.php');
include('validationerror.php');
include('validation.php');
include('connDriver.php');
if(isset($_POST['sign_up'])){
    
    $input=new validateinput($_POST, $con);
    $formvalue=$input->validateFunc();
   if ($input->checkError() === true) {
    # code...
    // echo "not meant to happen";
    # code...
    $email = $_POST['email'];
    $username=$_POST["username"];
    $password= password_hash($_POST["password"], PASSWORD_DEFAULT);
    // var_dump($password);
    $sql = "SELECT * FROM tbl_users WHERE email = '$email'";
    // print($sql);
    echo "Problem";
    $query = mysqli_query($con, $sql);
    if($query){
     if(mysqli_num_rows($query) > 0){
         $_SESSION['error'] = 'User Email already exists.';
         header('LOCATION:'.$_SERVER['HTTP_REFERER']);
     } else{
         $sql ="INSERT INTO tbl_users( username, email, password) VALUES ('$username', '$email', '$password')";
         $result = mysqli_query($con, $sql);
         if ($result) {
             # code...
             $_SESSION['success'] = 'Account created successfully.';
             header('LOCATION:../views/auth/login.php');
         } else {
             # code...
             $_SESSION['error'] = "Account could not be created successfully. Due to logical errors.";
             header('LOCATION:'.$_SERVER['HTTP_REFERER']);
             return true;
         }
     }
    } else {
     # code...
     echo 'save data into database.';
    }
    }else {
        header('LOCATION:'.$_SERVER['HTTP_REFERER']);
    }
}

// login if statement
if(isset($_POST['sign_in'])){
    $input=new validateinput($_POST,$con);
    $formvalue=$input->validateFunc();
   if ($input->checkError() === true) {
    # code...
    $email = $_POST['email'];
    $password= $_POST["password"];
    $sql="SELECT * from tbl_users WHERE email = '$email'";
    $query= mysqli_query($con,$sql);
    if (mysqli_num_rows($query)>0) {
        print "email exists.";
        # code...
        while($row = mysqli_fetch_assoc($query)){
            print_r($row);
      if (password_verify($password,$row['password'])) {
        # code...
        echo "password matches.";
      } else {
        # code...
        echo 'password does not match';
      }
      
      
        } 

    } else {
        print "email does not exist.";
        # code...
        $_SESSION['error'] = 'This email has not been registered.';
        header('LOCATION:'.$_SERVER['HTTP_REFERER']);
    }
    
   }
}

?>