<?php

namespace App\Services\Tags;

class Title extends Tag
{
    public function getTag(String $case = '', Array $args = [])
    {
        $provider = $this->providerFactory->getProvider($case, $args);
        
        switch ($case) {
            case 'product':
                $prefix = $provider->getString('category.name');
                $productName = $provider->getString('product.title');
                return $prefix . ' ' . $productName;
                
            case 'category':
            case 'color':
            case 'selection':
                $name = $provider->getString('name');
                $postfix = $provider->getString('postfix');
                $segments = [$name, $postfix];
                if(isset($args['pageN']) && $args['pageN'] > 1) {
                    $segments[] = 'стр. ' . $args['pageN'];
                }

                return implode(' — ', $segments);
            
            default:
                $line = $provider->getString('testTitle');
                return $line;
        }
    }
}