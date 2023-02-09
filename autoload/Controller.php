<?php

class Controller extends DB\SQL\Mapper
{
    public function __construct($table)
    {
        global $f3;
        parent::__construct($f3->get('DB'), $table);
    }

    public function getVolcano($type)
    {
        $this->load(['primary_volcano_type=?', $type]);
        return $this->cast();
    }

}