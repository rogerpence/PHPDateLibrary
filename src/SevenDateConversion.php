<?php

namespace App;

use DateTime;
use InvalidArgumentException;

class SevenDateConversion
{
    public function __construct()
    {
    }

    public function sevenDateToDate($sourceDate)
    {
        $sevenDate = sprintf("%07d", $sourceDate);

        if (!preg_match("/^(0|1)\d{6}$/", $sevenDate)) {
            throw new InvalidArgumentException('seven-digit date not valid');
        }

        $c  = substr($sevenDate, 0, 1);
        $yy = substr($sevenDate, 1, 2);
        $mm = substr($sevenDate, 3, 2);
        $dd = substr($sevenDate, 5, 2);
        $yyyy = (($c==="1") ? 2000 : 1900) + (int)$yy;

        if (!checkdate($mm, $dd, $yyyy)) {
            throw new InvalidArgumentException('Seven-digit date not in correct format.');
        }

        $date = new DateTime();
        $date->setDate($yyyy, $mm, $dd);

        return $date;
    }

    public function dateToSevenDate(DateTime $date)
    {
        return 1;
    }
}
