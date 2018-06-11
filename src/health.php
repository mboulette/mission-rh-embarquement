<?php
class health extends dataObject 
{

	protected $label;
	protected $phisicalEffectLevel;
	protected $mentalEffectLevel;
	protected $creditsMultiplicator;


	function __construct($id) {

        parent::__construct('health');
        
        $sql = '
        SELECT *
        FROM health_checkup WHERE id='.$id.'
        ';

    	$stmt = $this->db->prepare($sql);

    	$stmt->execute();
		$result = $stmt->get_result();

    	$array = $result->fetch_all(MYSQLI_ASSOC);
    	$stmt->close();

		$this->label = $array[0]['label'];
		$this->phisicalEffectLevel = $array[0]['phisical_effect_level'];
		$this->mentalEffectLevel = $array[0]['mental_effect_level'];
		$this->creditsMultiplicator = $array[0]['credits'];

	}


	function getLabel() {
		return $this->label;
	}

	function getPhisicalEffect() {
		
		if ($this->phisicalEffectLevel == 0) return '';

		$sql = '
		SELECT *
		FROM health_effects
		WHERE effect_type = "physic"
		AND level = '.$this->phisicalEffectLevel.'
		ORDER BY rand()
		';

    	$stmt = $this->db->prepare($sql);

    	$stmt->execute();
		$result = $stmt->get_result();

    	$array = $result->fetch_all(MYSQLI_ASSOC);
    	$stmt->close();

		return $array[0]['description'];
	}

	function getMentalEffect() {

		if ($this->mentalEffectLevel == 0) return '';

		$sql = '
		SELECT *
		FROM health_effects
		WHERE effect_type = "mental"
		AND level = '.$this->mentalEffectLevel.'
		ORDER BY rand()
		';

    	$stmt = $this->db->prepare($sql);

    	$stmt->execute();
		$result = $stmt->get_result();

    	$array = $result->fetch_all(MYSQLI_ASSOC);
    	$stmt->close();

		return $array[0]['description'];
	}

	function getCreditsMultiplicator() {
		return $this->creditsMultiplicator;
	}



}