<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <title>RTK RSS feed Suche</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      #padding-top {
				width: 100%; height: 60px;
      }
			q:before {content: "»";}
			q:after {content: "«";}
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>
<div class="visible-desktop" id="padding-top"></div>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">RSS Suche</a>
          <!--<div class="nav-collapse">i
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div>-->
        </div>
      </div>
    </div>

    <div class="container">
			
			<div class="row">
				<?php if (isset($_GET['q'])) {
					echo '<h1>Suche nach <q>' . htmlspecialchars($_GET['q']) . '</q></h1><ul>';
					foreach(glob('../archive/*') as $file) {
						$contents = file_get_contents($file);
						$parts = explode("\n", $contents, 3);
						if (stripos($parts[2], $_GET['q']) !== false) {
							if ($parts[1] == '') $parts[1] = $parts[0];
							echo '<li><a href="' . htmlspecialchars($parts[0])	. '">' . htmlspecialchars($parts[1]) . '</a></li>';
						}
					}
					echo '</ul>';
				} else { ?>
				<div class="span6 offset3 well">
					<h1>Suche nach:</h1>
					<form action="/" method="get" class="form-search">
						<input type="text" name="q" id="q" class="search-query input-xlarge">
						<input type="submit" class="btn btn-primary" value="Suche">
					</form>
				</div>
				<?php } ?>
			</div>
			
    </div> <!-- /container -->

  </body>
</html>
