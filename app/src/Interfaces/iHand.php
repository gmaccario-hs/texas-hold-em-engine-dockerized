<?php

namespace TexasHoldem\Interfaces;

use TexasHoldem\Models\Card;

interface iHand
{
    public function getOriginalIndex(): int;

    public function setOriginalIndex(int $originalIndex);

    public function getCards(): array;

    public function setCards(array $cards);

    public function addCard(Card $card);

    public function getScore(): int;

    public function setScore(int $score);

    public function getScoreName(): string;

    public function setScoreName(string $scoreName);

    public function getSpecificScore(): int;

    public function setSpecificScore(int $specificScore);
}
