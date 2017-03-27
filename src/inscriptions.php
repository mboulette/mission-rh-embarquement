<?php
class inscriptions extends dataObject 
{


	function __construct() {

		parent::__construct('inscriptions');

	}

	public function count($id) {

		$sql = '
		SELECT id
		FROM '.$this->objectName.'
		WHERE id_event=?
		GROUP BY id_player
		';

		$stmt = $this->db->prepare($sql);
		$stmt->bind_param('i', $id);

		$stmt->execute();
		$stmt->store_result();

		$count = $stmt->num_rows;
		$stmt->close();

		return $count;
	}

	public function playerParticipations($id_player) {
		$sql = '
		SELECT inscriptions.id as inscription_id, events.*
		FROM inscriptions LEFT JOIN events ON inscriptions.id_event = events.id
		WHERE inscriptions.id_player=?
		GROUP BY id_event
		ORDER BY events.date_event DESC
		';

		$stmt = $this->db->prepare($sql);
		$stmt->bind_param('i', $id_player);

		$stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $array;
	}


	public function characterParticipations($id_character) {
		$sql = '
		SELECT inscriptions.id as inscription_id, events.*
		FROM inscriptions LEFT JOIN events ON inscriptions.id_event = events.id
		WHERE inscriptions.id_character=?
		GROUP BY id_event
		ORDER BY events.date_event DESC
		';

		$stmt = $this->db->prepare($sql);
		$stmt->bind_param('i', $id_character);

		$stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $array;
	}

	public function playerHasRegistrations($id_player) {
		$sql = '
		SELECT id
		FROM '.$this->objectName.'
		WHERE id_player=?
		GROUP BY id_character
		';

		$stmt = $this->db->prepare($sql);
		$stmt->bind_param('i', $id_player);

		$stmt->execute();
		$stmt->store_result();

		$count = $stmt->num_rows;
		$stmt->close();

		return $count;
	}

	public function eventRegistrations($id_event) {
		$sql = '
		SELECT
		inscriptions.id as id,
        events.name as event_name,
        events.date_event as event_date,
        inscriptions.id_transaction as code,
        inscriptions.date_created as inscription_date,
        ROUND(SUM(amount),2) as total, 
        lastname, firstname,
        players.picture_url as player_pic,
		CONCAT(players.lastname, ", ", players.firstname) as player_name,
        YEAR(NOW()) - YEAR(players.birthday) - (DATE_FORMAT(NOW(), \'%m%d\') < DATE_FORMAT(players.birthday, \'%m%d\')) as age,
		gender, email, rank,
        characters.name as character_name,
        corporations.name as corporation_name,
        races.name as race_name,
        professions.name as profession_name,
        corporations.picture_url as corporation_pic,
        races.picture_url as race_pic,
        professions.picture_url as profession_pic       
		FROM inscriptions
		LEFT JOIN events ON inscriptions.id_event = events.id
		LEFT JOIN players ON inscriptions.id_player = players.id
		LEFT JOIN characters ON inscriptions.id_character = characters.id
        LEFT JOIN features as corporations ON corporations.id = characters.id_corporation
        LEFT JOIN features as races ON races.id = characters.id_race
        LEFT JOIN features as professions ON professions.id = characters.id_profession
		WHERE id_event=?
		GROUP BY id_character
		';

		$stmt = $this->db->prepare($sql);
		$stmt->bind_param('i', $id_event);

		$stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $array;
	}

	public function getAllEventRegistrations() {
		$sql = '
		SELECT
		inscriptions.id as id,
        events.name as event_name,
        events.date_event as event_date,
        inscriptions.id_transaction as code,
        inscriptions.date_created as inscription_date,
        ROUND(SUM(amount),2) as total,
        lastname, firstname,       
        players.picture_url as player_pic,
		CONCAT(players.lastname, ", ", players.firstname) as player_name,
        YEAR(NOW()) - YEAR(players.birthday) - (DATE_FORMAT(NOW(), \'%m%d\') < DATE_FORMAT(players.birthday, \'%m%d\')) as age,
		gender, email, rank,
        characters.name as character_name,
        corporations.name as corporation_name,
        races.name as race_name,
        professions.name as profession_name,
        corporations.picture_url as corporation_pic,
        races.picture_url as race_pic,
        professions.picture_url as profession_pic       
		FROM inscriptions
		LEFT JOIN events ON inscriptions.id_event = events.id
		LEFT JOIN players ON inscriptions.id_player = players.id
		LEFT JOIN characters ON inscriptions.id_character = characters.id
        LEFT JOIN features as corporations ON corporations.id = characters.id_corporation
        LEFT JOIN features as races ON races.id = characters.id_race
        LEFT JOIN features as professions ON professions.id = characters.id_profession
		GROUP BY id_character
		';
		$stmt = $this->db->prepare($sql);

		$stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $array;
	}

	public function playerIsRegistered($id_event, $id_player) {
		$sql = '
		SELECT id
		FROM '.$this->objectName.'
		WHERE id_event=? AND id_player=?
		GROUP BY id_character
		';

		$stmt = $this->db->prepare($sql);
		$stmt->bind_param('ii', $id_event, $id_player);

		$stmt->execute();
		$stmt->store_result();

		$count = $stmt->num_rows;
		$stmt->close();

		return $count;
	}

}