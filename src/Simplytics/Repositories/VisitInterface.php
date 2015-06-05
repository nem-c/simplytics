<?php

namespace NemC\Simplytics\Repositories;

interface VisitInterface
{
    const DEVICE_MOBILE = 1;
    const DEVICE_DESKTOP = 2;

    const SOURCE_GAG_NETWORK = 1;
    const SOURCE_PERSONAL_SITE = 2;
    const SOURCE_MOBILE_APP = 3;
    const SOURCE_API_FEEDER = 4;

    public function store($data);

    public function createTable();
}