<?php

class Mahasiswa {
    public string $nim;
    public string $nama;

// Constructor

        public function __construct(string $a, string $b) {

            $this->nim = $a;

            $this->nama = $b;

        }
}