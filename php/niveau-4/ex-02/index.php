<?php
class ville
{
	private $nom;
	private $departement;

	// c'est comme ça qu'on déclare le constructeur de la classe

	public function __construct($x, $y) 
	{
		$this->nom=$x;
		$this->departement=$y;
	}

	public function getinfo()
	{
		return "La ville de ".$this->nom." est dans le departement : " . $this->departement ;
	}
}

//Création d'objets
$ville1 = new ville("Nantes", "Loire-Atlantique");
$ville2 = new ville("Lyon", "Rhône");

echo $ville1->getinfo();
echo "<br>";
echo $ville2->getinfo();
?>