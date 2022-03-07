<?php

namespace TexasHoldem\Interfaces;

use TexasHoldem\Models\Handler;

interface iHandler
{
    public function setNext(Handler $handler): Handler;

    public function handle(string $request): ?string;
}