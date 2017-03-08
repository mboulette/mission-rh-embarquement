
    <div class="container">
      <div class="row">
        
        <div class="col-md-6 col-md-offset-6">
          <div class="signin-logo">
            <img class="img-responsive center-block" alt="Rh-PATAF" src="/inscriptions/img/home-header-logo.png">
          </div>
        </div>

        <div class="col-md-6 col-md-offset-6">


          <div class="panel panel-default signin-panel">
            <div class="panel-heading"><h4>Connectez-vous à partir de votre réseau social préféré</h4></div>
            <div class="panel-body">
              
              <div class="form-group">
                Sauvez des étapes et authentifiez-vous à l'aide de Facebook ou Google.
              </div>

              <div class="form-group">
                <a href="<?php echo $fb_login_url; ?>" class="btn btn-primary btn-lg"><i class="fa fa-facebook-official"></i> &nbsp;Facebook</a>
                <a href="/inscriptions/auth?action=google" class="btn btn-danger btn-lg"><i class="fa fa-google"></i> &nbsp;Google</a>
              </div>

            </div>
          </div>

          <div class="panel panel-default signin-panel">
            <div class="panel-heading"><h4>Connectez-vous à l'aide de votre courriel</h4></div>
            <div class="panel-body">

              <div class="msg-signin-lock alert alert-danger hidden">
                <p><strong>Désolé, votre compte a été verrouillé, contactez un administrateur.</strong></p>
              </div>

              <div class="msg-signin-error alert alert-danger hidden">
                <p><strong>Désolé, le courriel et le mot de passe que vous avez entrés ne correspondent pas à ceux présents dans notre système. Veuillez vérifier et réessayer.</strong></p>
                <p>Si vous êtes certain que votre adresse courriel est bonne, vous pouvez utiliser le lien «Mot de passe oublié ?» pour réinitialiser votre mots de passe. Si vous utilisez cette application pour la première fois, utilisez le bouton «Je suis nouveau !» où connectez-vous à l’aide de votre réseau social préféré. </p>
              </div>

              <div class="msg-signup-error alert alert-danger hidden">
                <p><strong>Désolé, le courriel que vous avez utilisé peut corresponde à un courriel déjà présent dans notre système. Veuillez vérifier et réessayer.</strong></p>
                <p>Si vous n'utilisez-pas cette application pour la première fois, vous pouvez utiliser le lien «Mot de passe oublié ?» pour réinitialiser votre mots de passe, où, connectez-vous à l’aide de votre réseau social préféré. </p>
              </div>

              <div class="msg-password-meter alert alert-danger hidden">
                <p><strong>Désolé, le mot de passe que vous avez utilisé est trop faible.</strong></p>
                <p>Pour rendre votre mot de passe plus fort, ajouter des charactères de type différents, comme des nombres, des majuscules, des minuscules, ou des charatères spéciaux. </p>
              </div>

              <form id="signin_form">

                <div class="form-group">
                  <label class="control-label" for="signin_email">Courriel</label>
                  <input type="email" class="form-control" id="signin_email" name="signin_email" placeholder="Courriel" autofocus required>
                </div>

                <div class="form-group">
                  <label class="control-label" for="signin_password">Mot de passe</label>

                  <div class="input-group">
                    <input type="password" class="form-control" id="signin_password" name="signin_password" placeholder="Mot de passe" required>
                    
                    <span class="input-group-addon">
                      <label><input id="signin_show_password" type="checkbox"> &nbsp;Afficher</lable>
                    </span>

                  </div>

                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-success"><i class="fa fa-lock"></i> &nbsp;Connexion</button>
                  <button id="sign-up" type="button" class="btn btn-default"><i class="fa fa-user-plus"></i> &nbsp;Je suis nouveau !</button>
                  <button id="forgot-password" type="button" class="btn btn-link">Mot de passe oublié ?</button>
                </div>

              </form>

            </div>


          </div>

            
          <?php require_once('src/templates/footer.php'); ?>

        </div>
          
      </div>

    </div>






    <div id="modal-forget-password" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Mot de passe oublié ?</h4>
          </div>
          <div class="modal-body">
            
            <p>Veillez saisir votre une adresse dans le champ courriel avant de cliquer sur le bouton «Mot de passe oublié ?», un message vous sera envoyé d'ici peu afin de vous expliquer la démarche à suivre pour retrouver votre mot de passe.</p>

            <p>
              <i class="fa fa-facebook-official"></i> <i class="fa fa-google"></i><br />
              Si vous vous êtes connecté à partir de Facebook ou Google les fois précédentes, un mot de passe vous a été attribué aléatoirement, mais vous n'avez pas besoin de le retenir, utilisez plutôt la connexion automatique du résau social en cliquant sur son bouton.</p>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




    <div id="modal-signup" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Je veux créer un compte</h4>
          </div>
          <div class="modal-body">
            
            <p>Pour vous inscrire, veillez saisir une adresse courriel valide dans le champ courriel et un mot de passe que vous pouvez facilement retenir, et cliquez ensuite sur «Je suis nouveau !». Votre compte sera automatiquement créé, et vous serai redirigé vers une page pour compléter les informations de votre profile.</p>

            <p>N’ayez crainte, votre mot de passe sera crypté et vos informations personnelles seront seulement partagées aux membres de l’organisation dans le but de vous fournir un meilleur produit. En vous inscrivant dans la Mission Rh-PATAF, vous acceptez de suivre les règles en vigueur, et vous consentez à reçevoir certain courriel de rappel ou de promotion.</p>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




    <div id="modal-reset" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Réinitialisé votre mot de passe</h4>
          </div>
          <div class="modal-body" >
            
            <p class="reset-modal-content"></p>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"> Ok </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

