<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'db/dbase.php';

// Ligação com a base de dados
$objUser = new User();

 /* Displays user information and some useful messages */
  session_start();

  // Check if user is logged in using the session variable
  if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "Deve efetuar o login antes de visitar o seu portal!";
    header("location: login/error.php");    
  }
  else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
  }

    // Display message about account verification link only once
  if ( isset($_SESSION['message']) ) {
    echo $_SESSION['message'];
                
    // Don't annoy the user with more messages upon page refresh
    unset( $_SESSION['message'] );
  }

  // Keep reminding the user this account is not active, until they activate
  if ( !$active ){
    echo '<div class="info"> A sua conta não foi verificada, por favor confirme no seu e-mail clicando no link!</div>';
  }
?>



<!doctype html>
<html lang="pt">
    <head>
        <!-- Head metas, css, and title -->
        <?php require_once 'includes/head.php'; ?>
    </head>
    <body>
        <!-- Header banner -->
        <?php require_once 'includes/header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                
        <!-- Sidebar menu -->
            <?php require_once 'includes/sidebar.php'; ?>
                
        <!-- Main -->
        <!--<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <iframe id="myFrame" src="default.html" width="100%" height=700 style="border:none;"></iframe>
            </div>
        </main>-->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <h1 style="margin-top: 10px">DataTable</h1>
            <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                              </tr>
                            </thead>
                            <?php
                              $query = "SELECT * FROM banco";
                              $stmt = $objUser->runQuery($query);
                              $stmt->execute();
                            ?>
                            <tbody>
                                <?php if($stmt->rowCount() > 0){
                                  while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                 <tr>
                                    <td><?php print($rowUser['id_banco']); ?></td>

                                    <td>
                                      <a href="form.php?edit_id=<?php print($rowUser['data']); ?>">
                                      <?php print($rowUser['data']); ?>
                                      </a>
                                    </td>

                                    <td><?php print($rowUser['descricao']); ?></td>

                                    <td><?php print($rowUser['valor']); ?></td>

                                    <td>
                                      <a class="confirmation" href="index.php?delete_id=<?php print($rowUser['id']); ?>">
                                      <span data-feather="trash"></span>
                                      </a>
                                    </td>
                                 </tr>


                          <?php } } ?>
                            </tbody>
                        </table>

                      </div>
        </main>
                    
        <!-- Custom scripts -->
        <script>
        // JQuery confirmation
            $('.confirmation').on('click', function () {
            return confirm('Are you sure you want do delete this user?');
            });
        </script>    
        
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>     
    
    </body>   
     
    <!-- Footer -->
    <footer class="page-footer font-small blue">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="https://www.linkedin.com/in/hugo-a-monteiro-2b965561/"> Hugo Monteiro</a>
        </div>


    </footer>
    
    
</html>