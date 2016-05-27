<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 01/02/16
 * Time: 08:37
 */

namespace Compared\Tools\Date;
use GException\DateException;


class FrenchDate
{

    protected $days = array ("Sunday"=>"Dimanche","Monday"=>"Lundi",
        "Tuesday"=>"Mardi","Wednesday"=>"Mercredi",
        "Thursday"=>"Jeudi", "Friday"=>"Vendredi",
        "Saturday"=>"Samedi");

    protected $months = array ("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");

    private $day, $month, $year, $day_name;

    public function __construct($options = NULL)
    {
        switch ($options)
        {
            case "now":
                $this->day = date("d");
                $this->year = date("Y");
                $this->month = $this->months[date("m") - 1];
                $this->day_name = $this->days[date("l")];
                break;
            default :
                throw new DateException("French Date conversion error");
        }
    }

    /**
     * @return array
     */
    public function getMonths()
    {
        return $this->months;
    }

    /**
     * @param array $months
     */
    public function setMonths($months)
    {
        $this->months = $months;
    }

    /**
     * @return bool|string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param bool|string $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return bool|string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param bool|string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return array
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param array $days
     */
    public function setDays($days)
    {
        $this->days = $days;
    }

    /**
     * @return mixed
     */
    public function getDayName()
    {
        return $this->day_name;
    }

    /**
     * @param mixed $day_name
     */
    public function setDayName($day_name)
    {
        $this->day_name = $day_name;
    }


}