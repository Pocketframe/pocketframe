<?php

namespace app\Traits;

trait HeadersTraits
{
    public function handle()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
    }
}
