<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="[meta_description]">
    <meta name="keywords" content="[meta_keywords]">
    <meta name="author" content="[author]">
    
    <title>{application_name} {title}</title>
    
    <!-- Bootstrap core CSS -->
    <link href="{site_dir}{interface}/assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap core CSS -->
    <link href="{site_dir}{interface}/assets/xcustom-defaults.css" rel="stylesheet">
    
    
    <!-- Documentation extras -->
    <link href="{site_dir}{interface}/assets/css/docs.min.css" rel="stylesheet">
    <link href="{site_dir}{interface}/assets/js/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="{site_dir}{interface}/assets/css/style.css" rel="stylesheet">
    <script src="{site_dir}{interface}/assets/js/ie-emulation-modes-warning.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js">
	</script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js">
	</script>
	<![endif]-->
    
    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" href="{site_dir}{interface}/assets/favicon.png">
    <link rel="icon" href="{site_dir}{interface}/assets/favicon.ico">
  </head>
  <body class="xcustom-bg-body">
    
    <!-- Docs master nav -->
    <header class="navbar navbar-static-top navbar-inverse" id="top" role="banner">
      <div class="container">
        <div class="navbar-header">
          <a href="{site_dir}{interface}" class="navbar-brand">
            <img src="{site_dir}{interface}/assets/img/logo.png" title="XCustom Admin Panel"> Admin & Client Panel
          </a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
          <ul class="nav navbar-nav navbar-right">
           	{mainmenu}
          </ul>
        </nav>
      </div>
    </header>

    <div class="container bs-docs-container">
		<div class="row">
			<div class="col-md-3">
			  <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm" role="complementary">
				<ul class="nav bs-docs-sidenav">
				 	{sidemenu}
				</ul>
			  </div>
			</div>
        
			<div class="col-md-9" role="main">
				<div class="bs-docs-section">
					<h2 id="overview" class="page-header">
					  {title}
					</h2>
					<div class="inner-section">
						<p>{notice_message}</p>
						{content}
					</div>
				</div> 
			</div> 
		</div> 
    </div>  
    <footer class="bs-docs-footer" role="contentinfo">
		<div class="container">
			
		</div>
    </footer>
    
    
    <!-- Bootstrap core JavaScript
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{site_dir}{interface}/assets/js/bootstrap.min.js"></script>
    <script src="{site_dir}{interface}/assets/js/docs.min.js"></script>
    <script src="{site_dir}{interface}/assets/js/google-code-prettify/prettify.js"></script>
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{site_dir}{interface}/assets/js/ie10-viewport-bug-workaround.js"></script>

    <script>
      $(function(){
        window.prettyPrint && prettyPrint();
      })
    </script>    
  </body>
</html>