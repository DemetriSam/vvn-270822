<?php

namespace App\Services\TextFormat;

use DiDom\Document;

class IdTagger
{
    private $html;

    public function setHtml($input)
    {
        $this->html = $input;
    }

    public function format()
    {
        $document = new Document($this->html);
        $headers = [];
        for ($i = 1; $i < 6; $i++) {
            $headers[$i] = $document->find('h' . $i);
            $cnt = 1;
            foreach ($headers[$i] as $element) {
                $element->attr('id', implode('', ['h', $i, '-', $cnt++]));
            }
        }

        return $document->toElement()->innerHtml();
    }
}
