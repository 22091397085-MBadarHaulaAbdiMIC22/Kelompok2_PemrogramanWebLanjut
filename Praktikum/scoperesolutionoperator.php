<?php

class Mahasiswa {

    public static function setNama (string $nama) {

        return $nama;

    }

}

// Instantiation with Scope resolution operator

echo Mahasiswa::setNama ('Faiza');