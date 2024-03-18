<?php

namespace App\Http\Utils;

class Organization
{
    protected $user;
    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function subordination()
    {

    }

    public function position()
    {
        return $this->user->CargoID;
    }

    public function branch()
    {

    }
}
