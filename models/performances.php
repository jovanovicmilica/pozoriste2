<?php
    require_once "connection.php";   


    if(isset($_GET['btn'])){
        $code=200;

        $limit=4;
        $offset=0;
        $page=0;
        $search="";

        if(isset($_GET['page'])){
            $page=$_GET['page']-1;
        }
        if(isset($_GET['search'])){
            $search=$_GET['search'];
        }

        $sum=0;
        $offset=$page*$limit;


        
        $query="SELECT *,p.id FROM performances p INNER JOIN prices pr
                ON p.id=pr.idPerformance  WHERE name like '%$search%'";
    
    
        try{
            $performances=$connection->query($query);
            if($performances->rowCount()!=0){
                $sum=$performances->rowCount();
                $data['sumPages']=ceil($sum/$limit);

                $query.=" LIMIT $limit OFFSET $offset";
                $data['performances']=$connection->query($query)->fetchAll();

                $data['currentPage']=$page+1;
            }
            else{
                $data['performances']=[];
            }
        }
        catch(Exception $e){
            $code=500;
            $data="Server error";
        }
    }
    else{
        $code=404;
        $data="Not found";
    }

    
echo json_encode($data);
http_response_code($code);
?>