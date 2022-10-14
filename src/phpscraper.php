<?php

namespace spekulatius;

class phpscraper
{
    /**
     * Holds the client
     *
     * @var spekulatius\Core;
     */
    protected $core = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->core = new Core();
    }

    /**
     * Catch alls to properties and process them accordingly.
     *
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        // We are assuming that all calls for properties actually method calls...
        return $this->call($name);
    }

    /**
     * Catches the method calls and tries to satisfy them.
     *
     * @param string $name
     * @param array $arguments = null
     * @return mixed
     */
    public function __call(string $name, array $arguments = null)
    {
        if ($name == 'call') {
            $name = $arguments[0];
            return $this->core->$name();
        } else {
            return $this->core->$name(...$arguments);
        }
    }
}