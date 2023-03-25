<?php

namespace Scandiweb\Databases;

interface IDatabase
{
    public function query($query);
    public function exec($query);
    public function generate();
}
