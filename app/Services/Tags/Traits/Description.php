<?php

namespace App\Services\Tags\Traits;

use App\Services\Tags\LinesProvider;

trait Description
{
    public function getDescription()
    {
        $provider = $this->getLineProvider();
        $desc = $provider->getString('description');

        $words = explode(' ', $desc);
        $wholeLen = 0;
        $maxLen = 152;
        $descShort = [];
        for ($i = 0; $i < count($words); $i++) {
            $currentWord = $words[$i];
            $wholeLen += strlen($currentWord);
            if ($wholeLen <= $maxLen) {
                $descShort[] = $currentWord;
            } else {
                break;
            }
        }

        return count($descShort) === count($words) ? implode(' ', $descShort) : implode(' ', $descShort) . '...';
    }

    abstract protected function getLineProvider() : LinesProvider;
}