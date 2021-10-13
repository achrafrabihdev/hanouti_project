<?php
trait Helper_Date
{

    public static function date_fr($date)
    {
        $d = new DateTime($date);
        return $d->format('d-m-Y');
    }
}