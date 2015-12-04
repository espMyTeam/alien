<?php

$no_visible_elements = true;
include('template/header.php'); ?>

    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>Administration de ALIENTECH</h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                Pour vous authentifier, entrez votre login et votre mot de passe.
            </div>
            <form class="form-horizontal" action="authentification.php" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user blue"></i></span>
                        <input type="text" class="form-control" placeholder="login" name="pseudo">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock blue"></i></span>
                        <input type="password" class="form-control" placeholder="mot de passe" name="pass">
                    </div>

                    
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary">Connexion</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
<?php require('template/footer.php'); ?>
