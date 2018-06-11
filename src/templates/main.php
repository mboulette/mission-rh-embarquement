<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="/inscriptions/img/apple-touch-icon.png">
    <link rel="icon" href="/inscriptions/img/favicon.ico">

    <title><?php echo $GLOBALS['app_name']; ?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.4.0/croppie.min.css" integrity="sha256-fZRiHCPpn3uG9ZK7nzn7vF1vr09RJBKXO8cPoSzbCSw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/inscriptions/css/daterangepicker.css" />
    <link rel="stylesheet" href="/inscriptions/css/fileinput.min.css">
    <link rel="stylesheet" href="/inscriptions/css/app.css?v3">
    <link rel="stylesheet" href="/inscriptions/css/avatar.css">
    <link rel="stylesheet" href="/inscriptions/css/font-awesome.min.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



  </head>
  <body>


    <noscript>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Le javascript est désactivé!</strong> &nbsp;
        <p>Cette application utilise le Javascript et les Cookies pour fonctionner. Nous sommes désolé que votre situation ne le permet pas, mais vous pouriez obtenir des résultats inatendus.</p>
        <a class="text-danger" href="http://www.enable-javascript.com/fr/" target="_blank">Voici les instructions pour activer le Javascript dans les navigateurs les plus commun.</a>
    </div>
    </noscript>

    <div id='cookiesOk'>
        <?php if (SID!='') { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Les Cookies sont désactivés!</strong> &nbsp;
            <p>Cette application utilise le Javascript et les Cookies pour fonctionner. Nous sommes désolé que votre situation ne le permet pas, mais vous pouriez obtenir des résultats inatendus.</p>
            <a class="text-danger" href="http://www.accepterlescookies.com/" target="_blank">Voici les instructions pour activer les Cookies dans les navigateurs les plus commun.</a>
        </div>
        <?php } ?>
    </div>

    <div id="oldbrowser" class="alert alert-danger alert-dismissible" role="alert" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Votre navigateur est désuet!</strong> &nbsp;
        <p>Vous utilisez présentement un navigateur qui pourrait ne pas supporter toutes les fonctionnalités requises pour utiliser cette application, vous pouriez obtenir des résultats inatendus.</p>
        <a class="text-danger" href="https://www.google.com/chrome/" target="_blank">Nous vous suggérons d'installer la dernière version de Google Chrome, le navigateur le plus utilisé dans le monde.</a>
    </div>

    <?php if (isset($_SESSION['message'])) { ?>
      <div class="session_message text-center">

        <div class="alert alert-<?php echo $_SESSION['message']['type']; ?> alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="Fermer">&times;</a>
          <p><?php echo $_SESSION['message']['body']; ?></p>
        </div>
        <?php unset($_SESSION['message']); ?>

      </div>
    <?php } ?>

    <?php echo $template ?>

    <script>
    if (!document.createElement('input').checkValidity) {
       document.getElementById("oldbrowser").style.display='block';
       document.body.style.backgroundImage = "none";
    }

    if (navigator.cookieEnabled) {
        document.getElementById("cookiesOk").style.display='none';
    }
    </script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.4.0/croppie.min.js" integrity="sha256-lzrvt84Vh0WIGhSfNrK3KP3Gowch7h42WR/FvgQj4e8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script src="https://js.squareup.com/v2/paymentform"></script>
    <script src="/inscriptions/js/moment.min.js"></script>
    <script src="/inscriptions/js/daterangepicker.js"></script>
    <script src="/inscriptions/js/bootstrap-numberpicker.js"></script>
    <script src="/inscriptions/js/fileinput.min.js"></script>
    <script src="/inscriptions/js/fileinput.fr.js"></script>
    <script src="/inscriptions/js/app.js?v4"></script>
    <script src="/inscriptions/js/avatar.js"></script>
    <script src="/inscriptions/js/daterangepicker-load.js"></script>
  </body>
</html>