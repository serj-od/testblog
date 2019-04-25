<?php

namespace Core;


class Model
{

    protected $db = null;

    protected function __construct()
    {
        $this->db = Db::getInstance()->getConnection();
    }
}