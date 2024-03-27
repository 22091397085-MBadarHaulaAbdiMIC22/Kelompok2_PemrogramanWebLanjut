<?php
class Mahasiswa {
    public string $nim;
    public string $nama;
    public static string $agama = "Islam";

    public function setNim(string $nim) {
        return $nim;

    }

    public function setNama (string $b) {


    // $this keyword refers a non-static member of a class 
    return $this ->nama =$b;
    }

    public function getNama() {

    // $this keyword refers a non-static member of a class return 
    $this->nama; 
    }

    public static function getAgama() {

    // self keyword refers a static member of a class

    return self::$agama;
    }
}



// Instantiation

$mhsw = new Mahasiswa();

echo $ahsw->setNim('17021000');

$mhsw->setNama('Faiza');

echo $ehsw->getHama();

echo $ahsw->getAgama();
