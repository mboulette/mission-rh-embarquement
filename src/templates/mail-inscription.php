
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
	<strong>Level :</strong> <?php echo $character['level'];?><br />
</p>


<h2>Options</h2>
<?php
$options = json_decode($inscription['options'], true);

foreach ($options as $option) {
	echo '<strong>'.$option['qty']. ' x '.$option['name'].' </strong>';
	foreach ($option as $key => $value) {
		if ($key != 'name' && $key != 'qty' && $key != 'total' && $key != 'price') {
			echo ' - ' . $key . ' : ' . $value;
		}
	}
	echo '<br />';

}
?>

<h3>Total Payé: $<?php echo $inscription['amount'];?></h3>

<hr />

<p>Merci de votre participation.</p>

<p>Ceci est un message automatisé.</p>

<p>
L’équipe de Mission Rh-PATAF<br />
<a href="mailto:<?php echo $GLOBALS['app_email']; ?>"><?php echo $GLOBALS['app_email']; ?></a>
</p>