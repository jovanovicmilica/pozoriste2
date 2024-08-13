<?php
    require_once "connection.php";
    
    $code=200;
    $data="Inserted";


    $name=$_POST['name'];
    $duration=$_POST['duration'];
    $premier=$_POST['premier'];
    $price=$_POST['price'];
    $description=$_POST['description'];

    $err=0;
    if(strlen($name)<1){
        $data="Name has 1 letter minimum";
        $err++;
    }
    if(!isset($_FILES['file'])){
        $data="You have to choose image";
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

        $ifNameExists="SELECT * FROM performances WHERE name like :name";

        $prepareTest=$connection->prepare($ifNameExists);

        $namePrepare="%".$name."%";
        $prepareTest->bindParam(":name",$namePrepare);


        try{
            $prepareTest->execute();

            if($prepareTest->rowCount()==1){
                $code=200;
                $data="Name already exists";
            }
            else{ 
                $slika=$_FILES['file'];
        
                $tmpName=$slika['tmp_name'];
                $size=$slika['size'];
                $tip=$slika['type'];
                $nameImage=$slika['name'];
                $naziv=time().$nameImage;
                $putanja="../assets/images/$naziv";
                move_uploaded_file($tmpName,$putanja);
    
                $query="INSERT INTO performances VALUES (null,:name,:description,:poster,:premier,:duration) ";
                
                $prepare=$connection->prepare($query);
            
                $prepare->bindParam(":name",$name);
                $prepare->bindParam(":description",$description);
                $prepare->bindParam(":poster",$naziv);
                $prepare->bindParam(":premier",$premier);
                $prepare->bindParam(":duration",$duration);
            
                $prepare->execute();
        
                $id=$connection->lastInsertId();
        
                
                $inserQuery="INSERT INTO prices VALUES (null,:price,:dateFrom,:idPerformance)";
        
                $prepare2=$connection->prepare($inserQuery);
        
                $date=date("Y-m-d");
    
                $prepare2->bindParam(":price",$price);
                $prepare2->bindParam(":dateFrom",$date);
                $prepare2->bindParam(":idPerformance",$id);
                $prepare2->execute();
                $data="Inserted";
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