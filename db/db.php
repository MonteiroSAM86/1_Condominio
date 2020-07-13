<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'condominio';
    
    // SET DSN - Data Source Name
    $dsn = 'mysql:host='. $host . ';dbname='. $dbname;

    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $password); 
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    # 1 - PDO Query
    //VER OS SEGUINTES EXEMPLOS:

    //$stmt = $pdo->query('SELECT * FROM posts'); 

    //while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        //echo $row['title']. '<br>'; 
    //}
    //      OU    
    //while($row = $stmt->fetch(PDO::FETCH_OBJ)){
        //echo $row->title. '<br>';
    //}

    # 2 - Preparede STATEMENTS (prepare & execute)
    //FETCH MULTPLI POSTS

    //$author = 'Hugo';
    //$is_published = true;
    //$id = 1;

        //2.1 - Possitional params
    //$sql ='SELECT * FROM posts WHERE author = ?';
    //$stmt = $pdo->prepare($sql);
   // $stmt->execute([$author]);
    //$posts = $stmt->fetchAll();

        //2.2 - Named Params
    //$sql ='SELECT * FROM posts WHERE author = :author && is_published = :is_published'; //multipas variaveis 
    //$stmt = $pdo->prepare($sql);
    //$stmt->execute(['author' => $author, 'is_published' => $is_published]);
    //$posts = $stmt->fetchAll();

       //aplicável ao 2.1 e 2.2
    //foreach($posts as $post){
    //echo $post->title. '<br>'; // devolve todos os titulos em que o autor foi o que está declarado na variavel $author
    //}

        //2.3 - FETCH SINGLE POST
    //$sql ='SELECT * FROM posts WHERE id = :id';
   //$stmt = $pdo->prepare($sql);
    //$stmt->execute(['id' => $id]);
    //$post = $stmt->fetch();

   // echo $post->body; //basta trocar o body por outra coluna e aparece o nosso dado 

        //2.4 - GET ROW COUNT
    //$stmt = $pdo->prepare('SELECT * FROM POSTS WHERE author = ?');
    //$stmt->execute([$author]);
    //$postCount = $stmt->rowCount();

    //echo $postCount;

        # 3 - ISERT DATA
    //$title = 'Post seven';
    //$body = 'This is post 7';
    //$author = 'Hugo';

    //$sql= 'INSERT INTO posts(title, body, author) VALUES(:title, :body, :author)';
    //$stmt = $pdo->prepare($sql);
    //$stmt->execute(['title' => $title, 'body' => $body, 'author' => $author]);
    //echo 'Post Added';

    # 4 - UPDATE
    //$id = 1;
    //$body = 'This this the updated post';

    //$sql= 'UPDATE posts SET body = :body WHERE id = :id';
    //$stmt = $pdo->prepare($sql);
    //$stmt->execute(['body' => $body, 'id' => $id]);
    //echo 'Post Updated';

