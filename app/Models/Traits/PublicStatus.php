<?php

namespace App\Models\Traits;

trait PublicStatus
{
    public function isPublished()
    {
        return $this->published === 'true';
    }

    public function retract()
    {
        $this->published = 'false';
        $this->save();
    }

    public function publish()
    {
        $this->published = 'true';
        $this->save();
    }
}
