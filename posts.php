<!doctype html>
<html lang="en">
    
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>

<?php include 'header.php';  ?>

<?php include 'work-with-database.php';  ?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <!---------------------------------------------------------->
                <!-- Ovde je bio kod koji sam sacuvao u backup-u pod brojem 1 -->
            <!---------------------------------------------------------->

            <?php
                        // pripremamo upit
            // $sql = "SELECT Id, Title, Body, Created_at, Author_id
            // FROM posts ORDER BY Created_at DESC";
            // $posts = getData($connection, $sql);

            $sort = 'DESC';

            $_POST['submit'] === 'Uzlazno' ? $sort = 'ASC' : $sort = 'DESC';

            $sql = "SELECT posts.Id, posts.Title, posts.Body, posts.Author_id, posts.Created_at, author.Ime, author.Prezime, author.Pol 
            FROM posts JOIN author ON posts.Author_id = author.Id ORDER BY Created_at ".$sort;

            $posts = getData($connection, $sql);

            $sql = "SELECT Ime, Prezime, Pol, Id FROM author";
            $authors = getData($connection, $sql);
            // echo "<pre>";
            // var_dump($posts);
            // echo "</pre>";

            ?>
            


            <form action="" method="post">
            <select name="chosen-author">
            <?php  
            
            foreach($authors as $author)
            {
                $author['Pol'] === 'Z'? $boja = 'roze' : $boja = 'plava';

                echo "<option value='{$author['Id']}' class=$boja>{$author['Ime']} {$author['Prezime']}</option>";
            }
            echo "<option value='Sve'>Prikazi Sve</option>";
            ?>
            </select>

            <input type="submit" name="submit" value="Filter">
            </form>

            <form action="" method="post">
            <input type="submit" name="submit" value="Uzlazno">
            <input type="submit" name="submit" value="Silazno">
            </form>

            <br>

            <?php
            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";

            //var_dump($_POST['chosen-author']);

                foreach ($posts as $post) {
                    if($post['Author_id'] === $_POST['chosen-author'] || !isSet($_POST['chosen-author']) || $_POST['chosen-author'] === 'Sve')
                    {
            ?>

            <div class="blog-post">
                <h2 class="blog-post-title"><a href="<?php echo('single-post.php?post-id='.$post['Id']); ?> "><?php echo ($post['Title']);?></a></h2>
                <p class="blog-post-meta"><?php echo ($post['Created_at']);?> by <a href="#"><?php echo ($post['Ime']." ".$post['Prezime']);?></a></p>

                <p><?php echo ($post['Body']);?></p>
            </div><!-- /.blog-post -->


            <?php
                    }
                }
            ?>

            

            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>



        </div><!-- /.blog-main -->

        <?php include 'sidebar.php';  ?>

    </div><!-- /.row -->

</main><!-- /.container -->

</body>

<?php include 'footer.php';  ?>

</html>