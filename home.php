<?php
# Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


  #Ligação Base de Dados
require_once 'db/dbase.php';

//Ligação com a base de dados
$objUser = new User();

  #LOGIN
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


  # GET Falta configurar 
if(isset($_GET['delete_id'])){
  $id = $_GET['delete_id'];
  try{
    if($id != null){
      if($objUser->delete($id)){
        $objUser->redirect('index.php?deleted');
      }
    }else{
      var_dump($id);
    }
  }catch(PDOException $e){
    echo $e->getMessage();
  }
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
      </div>
    </div>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 style="margin-top: 10px" class="h2">Conta Corrente</h1>   
      <?php
        $query = "SELECT FORMAT(SUM(IF (id_despesa>0, -1*valor, valor)),2) as saldo from banco";
        $stmt = $objUser->runQuery($query);
        $stmt->execute();
      ?>  
      <h5 style="margin-top: 10px">Saldo
        <?php 
          if($stmt->rowCount() > 0){
            while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
              print($rowUser['saldo']);
            }
          }
        ?> €&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
      </h5>
    </div>    
          
          <!--<h1 style="margin-top: 10px">DataTable</h1>-->
            <?php
              if(isset($_GET['updated'])){
                echo '<div class="alert alert-info alert-dismissable fade show" role="alert">   <strong>User!<trong> Updated with success.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span>
                </button></div>';
              }else if(isset($_GET['deleted'])){
                echo '<div class="alert alert-info alert-dismissable fade show" role="alert"><strong>User!<trong> Deleted with success.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button></div>';
              }else if(isset($_GET['inserted'])){
                echo '<div class="alert alert-info alert-dismissable fade show" role="alert"><strong>User!<trong> Inserted with success.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button></div>';
              }else if(isset($_GET['error'])){
                echo '<div class="alert alert-info alert-dismissable fade show" role="alert"><strong>DB Error!<trong> Something went wrong with your action. Try again!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button></div>';
              }
            ?>
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th></th>
                  </tr>
                </thead>
                <?php
                  $query = "SELECT * FROM banco";
                  $stmt = $objUser->runQuery($query);
                  $stmt->execute();
                ?>
                <tbody>
                  <?php 
                    if($stmt->rowCount() > 0){
                    while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                  ?>
                  <tr>
                    <td><?php print($rowUser['id_banco']); ?></td>
                    <td>
                      <a href="form.php?edit_id=<?php print($rowUser['id_banco']); ?>">
                        <?php print($rowUser['data']); ?>
                      </a>
                    </td>
                    <td><?php print($rowUser['descricao']); ?></td>
                    <td><?php print($rowUser['valor']); ?></td>
                    <td>
                      <a class="confirmation" href="index.php?delete_id=<?php print($rowUser['id_banco']); ?>">
                        <span data-feather="trash"></span>
                      </a>
                    </td>
                  </tr>
                  <?php } } ?>

                </tbody>
              </table>
            </div>
      </div>
    </main>


        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>

        <!-- Custom scripts -->
        <script>
            // JQuery confirmation
            $('.confirmation').on('click', function () {
                return confirm('Are you sure you want do delete this user?');
            });
        </script>
  </body>
  <!-- Footer -->
  <footer class="page-footer font-small blue">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
      <a href="https://www.linkedin.com/in/hugo-a-monteiro-2b965561/"> Hugo Monteiro</a>
    </div>
  </footer>
</html>
