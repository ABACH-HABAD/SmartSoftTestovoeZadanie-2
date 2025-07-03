<?php
class Review
{
    public static $ReviewList = [];

    function __construct(public $id,public $name, public $comment)
    {
        $this->id = $id;
        $this->name = $name;
        $this->comment = $comment;
    }
}
?>