<?php

use App\SevenDateConversion;

class SevenDateTest extends PHPUnit_Framework_TestCase
{
    public function testSevenDateToDate()
    {
        $sd = new SevenDateConversion();

        // Careful! A leading zero here means it's an octal value.
        $sevenDate = 1030630;
        $this->assertEquals("2003-06-30", $sd->sevenDateToDate($sevenDate)->format('Y-m-d'));

        $sevenDate = 30630;
        $this->assertEquals("1903-06-30", $sd->sevenDateToDate($sevenDate)->format('Y-m-d'));
    }

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testSevenDateToDateBadJuneDate()
    {
        $sd = new SevenDateConversion();

        // Careful! A leading zero here means it's an octal value.
        $sevenDate = 1030631;
        $this->assertEquals("2003-06-31", $sd->sevenDateToDate($sevenDate)->format('Y-m-d'));
    }

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testSevenDateToDateWithInvalidDate()
    {
        $sd = new SevenDateConversion();

        $sevenDate = 5030630;
        $this->assertEquals("2003-06-30", $sd->sevenDateToDate($sevenDate)->format('Y-m-d'));
    }

    public function testDateToSevenDate()
    {
        $date = new DateTime();
        $date->setDate(1959, 6, 2);

        $sd = new SevenDateConversion();

        $this->assertEquals(1, $sd->dateToSevenDate($date));
    }
}
