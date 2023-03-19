<?php

namespace Scandiweb\Databases;

abstract class Database implements IDatabase
{
    protected readonly mixed $_connection;

    abstract public function query($query);

    abstract public function seed();
}
