<?php

namespace App\Services\Tags;

class H1 extends Tag
{
    public function getTag(String $case = '', Array $args = [])
    {
        $provider = $this->providerFactory->getProvider($case, $args);
        
        switch ($case) {
            case 'product':
                $prefix = $provider->getString('category.name');
                $productName = $provider->getString('product.title');
                return $prefix . ' ' . $productName;
            
            case 'selection':
            case 'category':
            case 'color':
                return $provider->getString('name');
            
            default:
                $line = $provider->getString('testTitle');
                return $line;
        }
    }
}