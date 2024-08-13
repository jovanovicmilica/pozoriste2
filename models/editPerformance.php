<?php
    require_once "connection.php";
    
    $code=200;
    $data="Inserted";


    $name=$_POST['name'];
    $duration=$_POST['duration'];
    $premier=$_POST['premier'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    $id=$_POST['id'];

    $err=0;
    if(strlen($name)<1){
        $data="Name has 1 letter minimum";
        $err++;
    }
    if(strlen($description)<15){
        $data="Description has 15 letter minimum";
        $err++;
    }
    if($duration>180 || $duration==""){
        $data="Duration is number (minutes), values 180 maximum";
        $err++;
    }
    if($premier==""){
        $data="You have to choose premier date";
        $err++;
    }
    if($price==""){
        $data="You have to choose price";
        $err++;
    }

    if($err==0){
        $code=201;

        $ifNameExists="SELECT * FROM performances WHERE name like :name AND id!=:id";

        $prepareTest=$connection->prepare($ifNameExists);

        $namePrepare="%".$name."%";
        $prepareTest->bindParam(":name",$namePrepare);
        $prepareTest->bindParam(":id",$id);


        try{
            $prepareTest->execute();

            if($prepareTest->rowCount()==1){
                $code=200;
                $data="Name already exists";
            }
            else{ 
                
                if(isset($_FILES['file'])){
                    $slika=$_FILES['file'];
            
                    $tmpName=$slika['tmp_name'];
                    $size=$slika['size'];
                    $tip=$slika['type'];
                    $nameImage=$slika['name'];
                    $naziv=time().$nameImage;
                    $putanja="../assets/images/$naziv";
                    move_uploaded_file($tmpName,$putanja);

                    ///upis sa slikom
                    $query="UPDATE performances set name=:name,description=:description,poster=:poster,premier=:premier,duration=:duration where id=:id";
                    $prepare=$connection->prepare($query);
                    $prepare->bindParam(":poster",$naziv);
                }
                else{
                    ///upit bez slike
                    $query="UPDATE performances set name=:name,description=:description,premier=:premier,duration=:duration where id=:id";
                    $prepare=$connection->prepare($query);
                }
    
                
            
                $prepare->bindParam(":name",$name);
                $prepare->bindParam(":description",$description);
                $prepare->bindParam(":premier",$premier);
                $prepare->bindParam(":duration",$duration);
                $prepare->bindParam(":id",$id);
            
                $prepare->execute();
    
        
                
                $priceQuery="UPDATE prices SET price=:price,dateFrom=:dateFrom WHERE idPerformance=:id";
        
                $prepare2=$connection->prepare($priceQuery);
        
                $date=date("Y-m-d");
    
                $prepare2->bindParam(":price",$price);
                $prepare2->bindParam(":dateFrom",$date);
                $prepare2->bindParam(":id",$id);
                $prepare2->execute();
                $data="Updated";
            }
    
        }
        catch(PDOException $e){
            $data=$e->getMessage();
            $code=500;
        }
    }


    echo json_encode($data);
    http_response_code($code);
?>