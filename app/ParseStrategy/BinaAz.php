<?php

namespace App\ParseStrategy;

use FastSimpleHTMLDom\Document;

class BinaAz extends MasterStrategy
{
    public $conf_path = 'parsers.sites.bina_az';

    public function parse(): array
    {
        $html = new Document(file_get_contents($this->getConfig()['url']));
        $ret = $html->find('div[id=foo]');
        return $ret;
    }
}
