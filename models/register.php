<?php

    require_once "connection.php";

    $data="";

    if(isset($_POST['btnRegister'])){

        
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $passwordConf=$_POST['passConfirm'];
        
        $regName="/^[A-ZZŠĐŽČĆ][a-zzšđžčć]{2,29}$/";
        $regEmail="/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/";
        $regPass="/^.{8,50}$/";
        $greske=[];
        if(!preg_match($regName,$firstName)){
            array_push($greske,"First name has capital letter,3 letter minimum, 30maximum<br>");
        }
        if(!preg_match($regName,$lastName)){
            array_push($greske,"Last name has capital letter,3 letter minimum, 30maximum<br>");
        }
        if(!preg_match($regEmail,$email)){
            array_push($greske,"E-mail formats: petar.petrovic.123.21@ict.edu.rs or petar@gmail.com<br>");
        }
        if(!preg_match($regPass,$password)){
            array_push($greske,"Password must be at least 8 characters long<br>");
        }
        if($passwordConf!=$password){
           array_push($greske,"Passwords do not match<br>");
        }
      
        $mailProvera="SELECT email FROM users WHERE email=:mail";
        $priprema=$connection->prepare($mailProvera);
        $priprema->bindParam(":mail",$email);
        try{
            $priprema->execute();
            $rez=$priprema->fetch();
            if($priprema->rowCount()==1){
                $data="There is already a user with that email address";
                $code=200;
            }
            else{
                if(count($greske)==0){

                    $insert="INSERT INTO users VALUES(NULL,:ime,:prezime,:mail,:pass,:aktivan,:aktivacionikod,:regDate,:iduloge)";
                    $password=md5($password);
                    $uloga=2;
                    $aktivan=1;
                    $kod=md5(time().md5($email));
                    
                    //mail($mail,"Account activation","http://127.0.0.1/pozoriste/activation.php?code=".$kod);

                    $date=date("Y-m-d H:i:s");
                    
                    $priprema2=$connection->prepare($insert);
                    $priprema2->bindParam(":ime",$firstName);
                    $priprema2->bindParam(":prezime",$lastName);
                    $priprema2->bindParam(":mail",$email);
                    $priprema2->bindParam(":pass",$password);
                    $priprema2->bindParam(":aktivan",$aktivan);
                    $priprema2->bindParam(":aktivacionikod",$kod);
                    $priprema2->bindParam(":regDate",$date);
                    $priprema2->bindParam(":iduloge",$uloga);
                    try{
                        $uspesno=$priprema2->execute();
                        $code=201;
                        $data="You have successfully registered, check your email to activate your account";
                    }
                    catch(PDOException $e){
                        $code=500;
                        $data="Server error";
                    }
                }
                else{
                    $data=$greske;
                    $code=422;
                }
            }
        }
        catch(PDOException $e){
            $data= "Server error";
            $code=500;
        }
    
    }
    else{
        $code=404;
        $data="Error";
    }

echo json_encode($data);
http_response_code($code);
?>