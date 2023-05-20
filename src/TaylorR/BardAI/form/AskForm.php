<?php

declare(strict_types=1);

namespace TaylorR\BardAI\form;

use pocketmine\player\Player;

class AskForm
{

    public function __construct(
        protected Player $player
    ){}

    public function send(): void
    {
        // TODO: Send the form to the player
    }
}