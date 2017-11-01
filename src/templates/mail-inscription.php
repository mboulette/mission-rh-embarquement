
<img src="https://www.mission-rh.org/inscriptions/img/home-header-logo.png" width="200">

<p>Bonjour cher membre de l'équipage du Rh-PATAF,</p>

<p>Vous avez été inscrit à l'évènement «<?php echo $event['name']; ?>» Voici les détails de votre inscription.</p>
<p>Merci de présenter ce document aux personnes en charge lors de votre arrivée sur le terrain.</p>

<hr />

<h1>Inscription</h1>
<img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo $inscription['id_transaction'];?>" width="200">
<p>
	<strong>Évènement :</strong> <?php echo $event['name'];?><br />
	<strong>Date d'inscription :</strong> <?php echo $inscription['date_created'];?><br />
</p>

<h2>Joueur</h2>
<p>
	<strong>Nom :</strong> <?php echo $_SESSION['player']['firstname'].'  '.$_SESSION['player']['lastname'];?><br />
	<strong>Date de naissance :</strong> <?php echo substr($_SESSION['player']['birthday'], 0, 10);?><br />
	<strong>Sexe :</strong> <?php echo $_SESSION['player']['gender'];?><br />
	<strong>Courriel :</strong> <?php echo $_SESSION['player']['email'];?><br />
</p>

<h2>Personnage</h2>
<p>
	<strong>Nom :</strong> <?php echo $character['name'];?><br />
	<strong>Race :</strong> <?php echo $character['race']['name'];?><br />
	<strong>Profession :</strong> <?php echo $character['profession']['name'];?><br />
	<strong>Corporation :</strong> <?php echo $character['corporation']['name'];?><br />
	<strong>Grade :</strong> <?php echo $character['rank'];?><br />
</p>


<h2>Options</h2>
<?php
foreach (json_decode($inscription['options'], true) as $option) {
	echo '<strong>'.$option['qty']. ' x </strong>'.$option['name'].'<br />';
}
?>

<h2>Ressources</h2>
<?php
foreach (json_decode($inscription['ressources'], true) as $ressource) {
	echo '<strong>'.$ressource['qty']. ' x </strong>'.$ressource['name'].'<br />';
}
echo '<strong>'.$inscription['credits']. ' x </strong>Crédits restants<br />';
?>

<h3>Total Payé: $<?php echo $inscription['amount'];?></h3>

<hr />

<p>Merci de votre participation.</p>

<p>Ceci est un message automatisé.</p>

<p>
L’équipe de Mission Rh-PATAF<br />
<a href="mailto:<?php echo $GLOBALS['app_email']; ?>"><?php echo $GLOBALS['app_email']; ?></a>
</p>