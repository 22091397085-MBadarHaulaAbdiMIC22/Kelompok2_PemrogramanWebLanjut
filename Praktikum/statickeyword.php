<?php

class Mahasiswa {

    public static string $agama = "Islam";

    public static function getAgama() {

    // self keyword refers a static member of a class

    return self::$agama;

    }

}