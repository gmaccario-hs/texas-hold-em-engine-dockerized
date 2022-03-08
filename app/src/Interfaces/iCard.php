<?php

namespace TexasHoldem\Interfaces;

interface iCard
{
    public function getDenomination(): string;

    public function setDenomination(string $denomination);

    public function getDenominationConverted(): int;

    public function getSuit(): string;

    public function setSuit(string $suit);

    public function getSuitConverted(): int;
}
