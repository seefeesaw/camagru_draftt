<<!DOCTYPE html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <main>
            <section class="gallary-links">
                <div class="wrappers">
                    <h2>Gallary</h2>

                    <div class="gallary-container">
                        <a href="#">
                            <div></div>
                            <h3>This is a Title</h3>
                            <p>This is a paragraph</h3>
                        </a>

                        <a href="#">
                            <div></div>
                            <h3>This is a Title</h3>
                            <p>This is a paragraph</h3>
                        </a>

                    

                        <div class="gallary-upload">
                            <form action="gallary/uploads.php" method="post" enctype="multipart/form-data">
                            <input type="text" name="filename" placeholder="file name ...">
                            <input type="text" name="filetitle" placeholder="Image title ...">
                            <input type="text" name="filedscr" placeholder="Image Description ...">
                            <input type="file" name="file">
                            <button type="submit" name="submit">uploads</button>
                        </form>
                        </div>

                    </div>
                </div>
            </section>
        </main>


      
        
        <script src="" async defer></script>
    </body>
</html>