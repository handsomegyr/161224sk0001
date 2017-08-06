<?php

class MongoId
{

    protected $objId = null;

    public function __construct(string $id = '')
    {
        $this->objId = new \MongoDB\BSON\ObjectID($id);
    }

    public function __toString()
    {
        return $this->objId->__toString();
    }
}