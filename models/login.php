<?php
    session_start();

    require_once "connection.php";

    $data="";
    $code=200;
    if(isset($_POST['btnLogin'])){

        $mail=$_POST['email'];
        $pass=$_POST['password'];
    
        $regEmail="/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/";
        $regPass="/^.{8,50}$/";

        $greske=[];

        if(!preg_match($regEmail,$mail)){
            array_push($greske,"E-mail formats: petar.petrovic.123.21@ict.edu.rs or petar@gmail.com. <br>");
        }
        if(!preg_match($regPass,$pass) && strlen($pass)<8){
            array_push($greske,"Password must be at least 8 characters long. <br>");
        }

        if(count($greske)==0){
            $aktivan=1;
            $daLiPostojiKorisnik="SELECT * FROM users WHERE email=:email AND active=:aktivan";
            $priprema=$connection->prepare($daLiPostojiKorisnik);
            $priprema->bindParam(":email",$mail);
            $priprema->bindParam(":aktivan",$aktivan);
            try{
                $priprema->execute();
                if($priprema->rowCount()==1){
                    $upit="SELECT *,u.id FROM users u INNER JOIN roles r ON u.idrole=r.id WHERE email=:email AND password=:pass";
                    $pass=md5($pass);
                    $priprema2=$connection->prepare($upit);
                    $priprema2->bindParam(":email",$mail);
                    $priprema2->bindParam(":pass",$pass);
                    try{
                        $priprema2->execute();
                        $code=200;
                        if($priprema2->rowCount()==1){
                            $korisnik=$priprema2->fetch();
                            $_SESSION['user']=$korisnik;
                            $code=200;
                            $data="ok";
                        }
                        else{
                            $data="The password is incorrect";
                        }
                    }
                    catch(PDOException $e){
                        $code=500;
                        $data=$e->getMessage();
                    }
                }
                else{
                    $code=200;
                    $data="No user with that email address was found or the account was not activated";
                }
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
    else{
        $data="Sorry bit the page you are looking for does not exist, have been removed or you have to log in.";
        $code=404;
    }


    
echo json_encode($data);
http_response_code($code);

?>