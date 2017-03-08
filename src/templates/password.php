
    <div class="container">
      <div class="row">
        
        <div class="col-md-6 col-md-offset-6">
          <div class="signin-logo">
            <img class="img-responsive center-block" alt="Rh-PATAF" src="img/home-header-logo.png">
          </div>
        </div>

        <div class="col-md-6 col-md-offset-6">

          <div class="panel panel-default signin-panel">
            <div class="panel-heading"><h4>Réinitialisez votre mot de passe</h4></div>
            <div class="panel-body">

              <p>Entrez votre nouveau mot de passe dans le formulaire suivant pour remplacer le mot de passe associé à l'adresse courriel «<?php echo $_GET['email']; ?>»</p>

              <div class="msg-reset-error alert alert-danger hidden">
                <!--<a href="#" class="close" data-dismiss="alert" aria-label="Fermer">&times;</a>-->
                <p><strong>Erreur dans votre nouveau mot de passe</strong></p>
                <p>Les 2 champs doivent contenir exactement les même charactères. Notez que le lien du courriel pour réinitialiser votre mot de passe ne fonctionent plus si vous avez changé votre mot passe déjà une fois, vous devez vous l'envoyer à nouveau.</p>
              </div>

              <div class="msg-password-meter alert alert-danger hidden">
                <p><strong>Désolé, le mot de passe que vous avez utilisé est trop faible.</strong></p>
                <p>Pour rendre votre mot de passe plus fort, ajouter des charactères de type différents, comme des nombres, des majuscules, des minuscules, ou des charatères spéciaux. </p>
              </div>

              <form id="reset_form">

                <div class="form-group">
                  <label class="control-label" for="reset_password">Nouveau mot de passe</label>

                  <div class="input-group">
                    <input type="password" class="form-control" id="reset_password" name="reset_password" placeholder="Mot de passe" autofocus required>
                    
                    <span class="input-group-addon">
                      <label><input id="reset_show_password" type="checkbox"> &nbsp;Afficher</lable>
                    </span>

                  </div>

                </div>

                <div class="form-group">
                  <label class="control-label" for="reset_verification">Entrez votre mot de passe à nouveau</label>
                  <input type="password" class="form-control" id="reset_verification" name="reset_verification" placeholder="Vérification du mot de passe" required>
                </div>


                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-lock"></i> &nbsp;Réinitialisation</button>
                  <a href='/inscriptions' class="btn btn-default btn-lg">Annuler</a>
                </div>

                <input type='hidden' name='email' value='<?php echo $_GET['email']; ?>'>
                <input type='hidden' name='token' value='<?php echo $_GET['token']; ?>'>

              </form>

            </div>


          </div>

            
          <?php require_once('src/templates/footer.php'); ?>

        </div>
          
      </div>

    </div>


