
            <hr>
            <h4>Comments</h4>
            <br>

            <?php
                $check_comment_exist = false;

                foreach($comments as $comment)
                {
                    if((int)$_GET['post-id'] === (int)$comment['Post_id'])
                    {     
                        if($check_comment_exist === false)
                        {
                            echo "<ul>";
                        }

                        echo "<li> <label class='comment-author'>Author: {$comment['Ime']} {$comment['Prezime']}</label> <p class='comment-box'>{$comment['Text']}</p> </li><br>";

                        $check_comment_exist = true;
                    }
                }

                if($check_comment_exist === true)
                {
                    echo "</ul>";
                }

                if($check_comment_exist === false)
                {
                    echo "<p> No comments yet! </p>";
                }
            ?>