<?php

namespace TexasHoldem\Interfaces;

interface iRanking
{
    public function calculateRanking(array $cards): int;
}
