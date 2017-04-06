<?php

class home
{

	public function display() {
		
		$events_factory = new events();
		$inscriptions_factory = new inscriptions();
		$characters_factory = new characters();
		$cards_factory = new cards();
		$news_factory = new news();
		

        $template = get_template('navbar', array('active_menu' => 'home'));
        
        $step_template = get_template('step', array(
        	'profile_completed' => ($_SESSION['player']['completed'] != 0),
			'character_completed' => ($characters_factory->count($_SESSION['player']['id']) > 0),
			'creditcard_completed' => ($cards_factory->count() > 0),
			'player_has_registrations' => ($inscriptions_factory->playerHasRegistrations($_SESSION['player']['id']) > 0),
        ));

        
        $event = $events_factory->currentlyOpen();
        if (!empty($event)) {
        	$event['isRegistered'] = $events_factory->isRegistered($event['id']);
			$event['nbInscription'] = $events_factory->nbInscription($event['id']);
			$event['isActive'] = $events_factory->isActive($event);
			$event['nbInscriptionCorpo'] = $events_factory->nbInscriptionCorpo($event['id']);
        }

        $template .= get_template('home', array(
        	'step' => $step_template,
        	'news' => $news_factory->getList(),
        	'event' => $event,
        ));

		return render($template);
		
	}

}
