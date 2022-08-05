<?php
    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite
    error_reporting(E_ERROR | E_PARSE);

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "blog";

    try
    {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

    function getData($connection, $sql, $isFetchAll = true)
    {
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        return $isFetchAll ? $statement->fetchAll() : $statement->fetch();
    }

    function submitComment($connection)
    {     
            //var_dump($_POST);
            $Author = $_POST['author'];
            $Comment = $_POST['comment'];
            $Post_id = $_GET['post-id'];

            if(empty($Author) || empty($Comment) || empty($Post_id))
            {
                echo "<label class='poruka-komentar'>Ime i komentar moraju biti uneti!</label>";
            }
            else
            {
                $currentDate = date('Y-m-d');
                $sql = "INSERT INTO comments (Author_id, Text, Post_id) VALUES ( '$Author', '$Comment', '$Post_id')";
                
                $statement = $connection->prepare($sql);
                $statement->execute();
                header("Location: ./single-post.php?post-id=".$_GET['post-id']);
            }  
    }


    function createPost($connection)
    {
        $Title = $_POST['title'];
        $Body = $_POST['body'];
        $Author_id = (int)$_POST['chosen-author'];
        //$Created_at = $_POST['date'];

        if(empty($Author_id) || empty($Title) || empty($Body))
        {
            echo "<br><br><label class='poruka-post'>Unesite sve podatke!</label>";
        }
        else
        {
            $currentDate = date('Y-m-d');
            $sql = "INSERT INTO posts (Title, Body, Author_id, Created_at) VALUES ('$Title', '$Body', '$Author_id', '$currentDate')";
            
            $statement = $connection->prepare($sql);
            $statement->execute();
            header("Location: ./posts.php");
        } 
    }


    function createAuthor($connection)
    {
        $Ime = $_POST['ime'];
        $Prezime = $_POST['prezime'];
        $Pol = $_POST['pol'];
        //$Created_at = $_POST['date'];

        if(empty($Ime) || empty($Prezime) || empty($Pol))
        {
            return "<label class='poruka-autor-upis-greska'>Unesite sve podatke!</label>";
        }
        else
        {
            $currentDate = date('Y-m-d');
            $sql = "INSERT INTO author (Ime, Prezime, Pol) VALUES ('$Ime', '$Prezime', '$Pol')";
            
            $statement = $connection->prepare($sql);
            $statement->execute();
            //header("Location: ./create-author.php");
            return "<label class='poruka-autor-upis'>Upis zavrsen!</label>";
        } 
    }
    
?>