<?php

namespace app\components;

class RupiahFormatter
{
    public static function format($angka)
    {
        return "Rp " . number_format($angka, 0, ',', '.');
    }
}
