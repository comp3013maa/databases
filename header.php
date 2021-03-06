<?php
ob_start(); // ignore, prevents errors when redirecting 

/* if session not already created, create it */
if(!isset($_SESSION))  {
	session_start(); // 
}  

/* If more than an hour since last activity, destroy session */
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}

/*  if session still active - update last activity to current time  */ 
$_SESSION['LAST_ACTIVITY'] = time(); 
?> 

<link href="include/bootstrap-3.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
<link href="include/style.css" rel="stylesheet" type="text/css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) - maybe not actually be used - ignore largely -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="include/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>

<!-- NAVBAR -->
 <div class="navbar navbar-default navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" id="logoDesign" href="index.php">COMP3013</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>

          <?php if( !isset ($_SESSION['userID']) ) {?> 
            <form class="navbar-form pull-right" method = "POST" action="login.php">
             <input id="textinput" name="username" type="text" class="form-control input-md" placeholder="Username">
             <input id="passwordinput" name="password" type="password" class="form-control input-md" placeholder="Password">
              <button type="submit" class="btn btn-primary" name="loginForm">Sign in</button>
            </form>
          <?php }  ?>

          <ul class="nav navbar-nav navbar-right">

            <?php  if( isset ($_SESSION['userID']) ) {?> 
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" id="logoDesign">Welcome, <?php echo $_SESSION['userName']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="contact.php"><i class="icon-envelope"></i> Contact Support</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
                        </ul>
            </li>
            <?php } ?>

            <!-- For other things in the rigth section of the menu, just use li e.g. 
             <li><a href="logout.php"> Log Out </a> </li>
            -->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    
    <!-- SIDEBAR --> 
  <div class="col-md-3">
    <ul class="nav nav-pills nav-stacked admin-menu">
        <li class=""><a href="index.php">Home</a></li>
        <li><a href="upload.php">Upload Reports </a></li>
        <li><a href="groupreports.php">Group Reports</a></li>
        <li><a href="admin.php">Admin </a></li>
        <li><a href="forum.php" data-target-id="forms">Forums </a></li>
    </ul>
</div>

<!-- CONTENT - the end </divs> we've placed into our footer -->
<div class="container"> <!-- Container for everything under navbar -->
 <div class="row">
   <div class="col-md-9 well admin-content" > <!-- grey main body box --> 

<?php 
if( isset ($_SESSION['userID']) ) {
	define("DEBUG", true);
	if (DEBUG) {
	    	ini_set("display_errors",1);
	    	ini_set("display_startup_errors",1);
		 error_reporting(E_ALL & ~E_NOTICE);
	}

} 
?>
