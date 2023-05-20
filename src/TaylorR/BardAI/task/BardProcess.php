<?php

declare(strict_types=1);

namespace TaylorR\BardAI\task;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use TaylorR\BardAI\form\ResultForm;
use TaylorR\BardAI\Loader;
use TaylorR\MeetBard\Bard;
use TaylorR\MeetBard\security\User;

class BardProcess extends AsyncTask
{

    public function __construct(
        private string $username,
        private string $question,
        private User $user
    ){}

    public function onRun(): void
    {
        $bard = new Bard($this->user);
        $response = $bard->ask($this->question);
        $this->setResult($response['content']);
    }

    public function onCompletion(): void
    {
        $response = $this->getResult();
        $player = Server::getInstance()->getPlayerByPrefix($this->username);
        if (is_null($player)) {
            return;
        }
        ResultForm::send($player, $response);
    }
}