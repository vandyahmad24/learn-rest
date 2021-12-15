<?php

namespace App\Helpers;

/**
 * Format response.
 */
class MerubahRpJadiAngka
{
    public static function ChangeRpAngka($angka)
    {
        // Rp. 50.0000
        $string = str_replace("Rp. ","",$angka);
        // 50.0000
        $angka = str_replace(".","",$string);
        return $angka;

    }

}