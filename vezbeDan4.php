<?php

abstract class Soba
{
    protected $brojSobe;
    protected $tipSobe;
    protected $kupatilo;
    protected $balkon;
    protected $slobodna;
    protected function __construct(int $brojSobe,int $tipSobe = 0, bool $kupatilo, bool $balkon)
    {
        $this->brojSobe = $brojSobe;
        $this->tipSobe = $tipSobe;
        $this->kupatilo = $kupatilo;
        $this->balkon = $balkon;
        $this->slobodna = true;
    }
    public function getBrojSobe()
    {
        return $this->brojSobe;
    }
    public function isAvailable()
    {
        return $this->slobodna;
    }
    public function iznajmi()
    {
        $this->slobodna = false;
    }
    public function leave()
    {
        $soba = $this->listaSoba[$this->brojSobe];
    }
}
class Jednokrevetna extends Soba
{
   public function __construct(int $brojSobe, int $tipSobe = 1, bool $kupatilo, bool $balkon)
   {
       parent::__construct($brojSobe, $kupatilo, $balkon);
      
   }
}
class Dvokrevetna extends Soba
{
    public function __construct(int $brojSobe, int $tipSobe = 2,  bool $kupatilo,bool $balkon)
    {
        parent::__construct($brojSobe, $kupatilo, $balkon);
       
    }
}
class Trokrevetna extends Soba
{
    public function __construct(int $brojSobe,int $tipSobe = 3, bool $kupatilo,bool $balkon)
   {
       parent::__construct($brojSobe, $kupatilo, $balkon);
       
   }
}
class Hotel
{
    public $listaSoba;
    public $slobodneSobe;
    public function __construct()
    {
		$this->listaSoba = [];
		$this->slobodneSobe = [
			'Jednokrevetna' => 0,
			'Dvokrevetna' => 0,
			'Trokrevetna' => 0
        ];
    }
        public function dodajSobu($soba)
        {
            $this->listaSoba[$soba->getBrojSobe()] = $soba;
            $this->slobodneSobe[get_class($soba)]++;
        
         }
    public function iznajmiSobu($type)
    {
		$type = get_class($soba);
    }
    function getRoom($type)
{
    if ($this->slobodneSobe[$type] == 0) {
        echo 'Nema soba tipa ' . $type;
        return;
    }

    foreach ($this->listaSoba as $soba) {
        if ($soba->isAvailable() && $soba instanceof $type) {
            $soba->rent();
            $this->slobodneSobe[$type]--;
        }
    }
}
}
class User
}
    private $ime;
    private $prezime;
    private $jmbg;

    public function __construct(string $ime, string $prezime, int $jmbg)
    {
        
    }
}
    $jednokrevetna = new Jednokrevetna(2, true, false);
    $jednokrevetna2 = new Jednokrevetna(13, true, true);
    $jednokrevetna3 = new Jednokrevetna(17, true, true);
    
    
    
    $dvokrevetna = new Dvokrevetna(4, true, false);
    $dvokrevetna2 = new Dvokrevetna(14, true, true);
    $dvokrevetna3 = new Dvokrevetna(21, true, true);
    
    
    $trokrevetna = new Trokrevetna(7, true, false);
    $trokrevetna2 = new Trokrevetna(15, true, true);
    $trokrevetna3 = new Trokrevetna(23, true, true);
    
    $hotel = new Hotel();
    $hotel->dodajSobu($jednokrevetna);
    $hotel->dodajSobu($jednokrevetna2);
    $hotel->dodajSobu($jednokrevetna3);
    
    $hotel->dodajSobu($dvokrevetna);
    $hotel->dodajSobu($dvokrevetna2);
    $hotel->dodajSobu($dvokrevetna3);
    
    $hotel->dodajSobu($trokrevetna);
    $hotel->dodajSobu($trokrevetna2);
    $hotel->dodajSobu($trokrevetna3);
    
    echo "<pre>";
    var_dump($hotel);
    echo "</pre>";


