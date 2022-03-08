<?php

namespace TexasHoldem\Interfaces;

interface iRanking
{
    public function getRankName(): string;
    public function getDenominations(): int;
    public function calculateRanking(array $cards): int;
}
