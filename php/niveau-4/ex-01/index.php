<?php
class ville
{
	public $nom;
	public $departement;

	public function getinfo()
	{
		return "La ville de ".$this->nom." est dans le departement : " . $this->departement ; // réfléchir à ce que cette méthode doit renvoyer
	}
}

//Création d'objets

// on créé une première ville
$ville1 = new ville(); // on appelle le constructeur de classe
$ville1->nom="Nantes"; // on lui donne son nom
$ville1->departement="Loire-Atlantique";

$ville2 = new ville();
$ville2->nom= "Grasse";
$ville2->departement= "Alpes-Maritimes";
echo $ville1->getinfo();
echo "<br>";
echo $ville2->getinfo();
?>