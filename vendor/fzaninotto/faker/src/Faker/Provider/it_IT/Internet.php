<?php

namespace Faker\Provider\it_IT;

class Internet extends \Faker\Provider\Internet
{
    protected static $freeEmailDomain = array('gmail.com', 'yahoo.com', 'hotmail.com', 'messageEmail.it', 'libero.it', 'yahoo.it');
    protected static $tld = array('com', 'com', 'com', 'net', 'org', 'it', 'it', 'it');
}
