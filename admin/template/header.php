<html lang="fr">
  <head>
	<title>Administration AlienTech</title>
    <?php include_once('meta.php');?>
  </head>
  <body role="document">
<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
	    <!--Topbar-->
	    <?php include_once('topbar.php');?>
     <!-- fin Topbar-->
<?php } ?>
<div class="ch-container">
    <div class="row">
        <?php if (!isset($no_visible_elements) || !$no_visible_elements) { include_once('menu.php');?>
		<div id="content" class="col-lg-9 col-sm-9">
            <!-- Contenu: tout le contenu de notre site sera placé dans cette partie -->
            <?php } ?>
			
