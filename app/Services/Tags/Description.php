<?php

namespace App\Services\Tags;

class Description extends Tag
{
    public function getTag(String $case = '', array $args = [])
    {
        $provider = $this->providerFactory->getProvider($case, $args);
        
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
}
