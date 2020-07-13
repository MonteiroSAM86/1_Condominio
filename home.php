<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'db/db.php';

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
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <iframe id="myFrame" src="default.html" width="100%" height=700 style="border:none;"></iframe>
            </div>
        </main>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <h1 style="margin-top: 10px">DataTable</h1>
                    
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