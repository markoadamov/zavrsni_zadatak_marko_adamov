<!doctype html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Blog</title>

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

            <?php
                $sort = 'DESC';

                $_POST['submit'] === 'Uzlazno' ? $sort = 'ASC' : $sort = 'DESC';

                $sql = "SELECT posts.Id, posts.Title, posts.Body, posts.Author_id, posts.Created_at, author.Ime, author.Prezime, author.Pol 
                FROM posts JOIN author ON posts.Author_id = author.Id ORDER BY Created_at ".$sort;

                $posts = getData($connection, $sql);

                $sql = "SELECT Ime, Prezime, Pol, Id FROM author";
                $authors = getData($connection, $sql);
            ?>
            
            <div class="drop-down-menu-and-buttons">
                <form action="" method="post"> <!-- Drop-down menu za odabir autora ili svih autora-->
                    <select name="chosen-author">
                        <?php
                            echo "<option value='Sve' style='color: black;'>All Authors</option>";

                            foreach($authors as $author)
                            {
                                $author['Pol'] === 'Z'? $boja = 'roze' : $boja = 'plava'; // $boja prima ime klase na osnovu pola

                                echo "<option value='{$author['Id']}' class=$boja>{$author['Ime']} {$author['Prezime']}</option>";
                            }
                        ?>
                    </select>

                    <input type="submit" name="submit" value="Filter"> <!-- Dugme Filter -->
                </form>

                <form action="" method="post"> <!--Dugmad za sortiranje postova po datumu objave-->
                    <input type="submit" name="submit" value="Uzlazno">
                    <input type="submit" name="submit" value="Silazno">
                </form>
            </div>

            <br>

            <?php
                foreach ($posts as $post) // Prolazak kroz sve postove dovucene iz baze, ako $_POST['chosen-author'] nije setovan ili je vrednost 'Sve', prikazuju se svi postovi ili ako se poklapa sa $post['Author_id'] prikazuje se taj post
                {
                    if($post['Author_id'] === $_POST['chosen-author'] || !isSet($_POST['chosen-author']) || $_POST['chosen-author'] === 'Sve')
                    {
            ?>

            <div class="blog-post"> <!-- Prikaz posta na stranici-->
                <h2 class="blog-post-title"><a href="<?php echo('single-post.php?post-id='.$post['Id']); ?> "><?php echo ($post['Title']);?></a></h2>
                <p class="blog-post-meta"><?php echo ($post['Created_at']);?> by <label><?php echo ($post['Ime']." ".$post['Prezime']);?></label></p>

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