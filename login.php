<!DOCTYPE html>
<html>
  <head>
	  <title>HomeMade APP</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <!-- Bootstrap -->
	  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <!-- styles -->
	  <link href="css/styles.css" rel="stylesheet">

	  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
	  <script src="./js/html5shiv.js"></script>
	  <script src="./js/respond.min.js"></script>
	  <![endif]-->
  </head>
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">HomeMade APP</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
							<h6>Sign In</h6>
						  <form id="login" action="./set/verifica.php" method="post">

			                <input class="form-control" name="username" type="text" placeholder="Username" required >
			                <input class="form-control" name="password" type="password" placeholder="Password" required >
			                <div class="action">

								<button class="btn btn-primary signup">Login</button>
			                </div>
						  </form>
			            </div>
			        </div>


			    </div>
			</div>
		</div>
	</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="./js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>