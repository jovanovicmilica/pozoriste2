<?php
require_once "connection.php";
$upit = "SELECT * FROM poll WHERE active=1";
try
{
    $anketa = $connection->query($upit);
    if ($anketa->rowCount() == 1)
    {
        $aktivna = $anketa->fetch();
        $idAnkete = $aktivna['id'];
        $upit2 = "SELECT * FROM answers WHERE idPoll=$idAnkete";
        $odg = $connection->query($upit2);
        if ($odg->rowCount() != 0)
        {
            $odgovori = $odg->fetchAll();
            if (isset($_SESSION['user']))
            {
                $user = $_SESSION['user'];
                $id = $user['id'];
                $upit3 = "SELECT * FROM useranswers ua INNER JOIN answers a on ua.idAnswer=a.id WHERE idPoll=$idAnkete AND idUser=$id";
                $odgovorKorisnika = $connection->query($upit3);
                if ($odgovorKorisnika->rowCount() == 1)
                {
                    $test = $odgovorKorisnika->fetch();
                    $obavestenje = "You have already voted!";
                }
            }
            else
            {
                $obavestenje = "Login to vote!";
            }
        }
    }
    else
    {
        $message = "There is no active poll currently";
    }
}
catch(PDOException $e)
{
    $message = "Server error";
}
?>
