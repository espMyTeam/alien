		<!-- contenu de la page -->
		<?php
			session_start();
			if(isset($_SESSION['pseudo']) && isset($_SESSION['pass']))
			{
				include("template/header.php");
				include('template/header_file.php');
		?>
		<section>
			<?php
				require_once("../scripts/base_connexion.php");
				require_once("../scripts/traitement.php");
				require_once("../scripts/requetes.php");

				$clients = selectionneClients($base);
			
?>

    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>UID</th>
        <th>N° Tel</th>
        <th>Date Inscription</th>
        <th>Extension Couverture</th>
        <th>UFR</th>
        <th>Adresse MAC</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
	<?php
				while($client=$clients->fetch()) {
					
					?>
					

    <tr>
        <td><?php echo $client['client_UID'];?></td>
        <td class="center"><?php echo $client['client_numTel'];?></td>
        <td class="center"><?php echo $client['client_dateInsc'];?></td>
        <td class="center"><?php echo $client['client_extCouv'];?></td>
        <td class="center"><?php echo $client['client_UFR'];?></td>
        <td class="center"><?php echo $client['client_adrMac'];?></td>
        <td class="center">
            <a class="btn btn-success" href="#">
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                infos
            </a>
            <a class="btn btn-info" href="modifier_client.php?client=<?php echo "" . $client['client_UID'];?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            <a class="btn btn-danger" href="supprimer_client.php?client=<?php echo "" . $client['client_UID'];?>">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
            </a>
        </td>
    </tr>
		<?php } ?>
			
    </tbody>
    </table>
    
		</section>

		 
		
		<?php
			include('template/footer_file.php');}
			
			else
			{
				session_destroy();
				header("location: index.php");
			}
			include("template/footer.php");
		?>
