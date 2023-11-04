<?php

namespace App\Models\Interfaces;

interface HasPublicStatus
{
    public function isPublished();
    public function retract();
    public function publish();
}
