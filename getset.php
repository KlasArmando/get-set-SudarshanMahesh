<?php
/**
 * Created by PhpStorm.
 * User: sudarshanmahesh
 * Date: 2019-02-05
 * Time: 12:38
 */

class Kassabon {
	public $producten;
	public $totaal;
	public $datum;


	public function setProduct( $naam, $prijs ) {
		$this->totaal      += $prijs;
		$this->producten[] = new Product( $naam, $prijs );
	}

	public function getDatum() {
		$today       = getdate();
		$this->datum = $today["mday"] . "-" . $today["mon"] . "-" . $today["year"];

		return $this->datum;

	}

	public function getProduct( $id ) {
		return $this->producten[ $id ];
	}

	public function getPrice( $tax ) {
		$totaal = $this->totaal;

		if ($tax == true) {
			return round( $totaal * 1.21, 2 );
		} else {
			return round($totaal, 2);
		}
	}
}

class Product {
	public $naam;
	public $prijs;

	public function __construct( $naam, $prijs ) {
		$this->naam  = $naam;
		$this->prijs = $prijs;
	}
}

$wasmachineprijs = $_POST["Wasmachine"];
$drogerprijs     = $_POST["Droger"];
$koelkastprijs   = $_POST["Koelkast"];

$bon1 = new Kassabon();
$bon1->setProduct( "Wasmachine", $wasmachineprijs );
$bon1->setProduct( "Droger", $drogerprijs );
$bon1->setProduct( "Koelkast", $koelkastprijs );

echo "Datum: " . $bon1->getDatum();
echo "<br>Wasmachine: " . $bon1->getProduct( 0 )->prijs;
echo "<br>Droger: " . $bon1->getProduct( 1)->prijs;
echo "<br>Koelkast: " . $bon1->getProduct( 2 )->prijs;
echo "<br>Totaal prijs ex btw: " . $bon1->getPrice(false);
echo "<br>Totaal prijs inc btw: " . $bon1->getPrice(true);