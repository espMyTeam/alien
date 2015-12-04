 <div class="navbar navbar-default" role="navigation">
        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"> 
			<!--<img alt="admin logo" src="img/logo20.png" class="hidden-xs"/>-->
				<span>AlienTech</span><strong>Admin</strong> 
			</a>
            <!-- infos utilisateur -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs">Admin: <?php echo $_SESSION['pseudo']; ?> </span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="login.php">Paramètres</a></li>
                    <li class="divider"></li>
                    <li><a href="login.php">Logout</a></li>
                </ul>
            </div>
            <!--fin infos utilisateurs-->
        </div>
    </div>
  
