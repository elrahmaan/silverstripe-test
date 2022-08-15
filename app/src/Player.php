<?php
use SilverStripe\ORM\DataObject;

class Player extends DataObject 
{
    private static $db = [
        'PlayerNumber' => 'Int',
        'FirstName' => 'Varchar(255)',
        'LastName' => 'Text',
        'Birthday' => 'Date'
    ];

}
