<?php

interface ValidatorInterface
{
    public function validate($value);
}

class DateValidator implements ValidatorInterface
{
    public function validate($value)
    {
        $dateArray = explode('. ', $value);
        return checkdate((int)$dateArray[1], (int)$dateArray[0], (int)$dateArray[2]);
    }
}