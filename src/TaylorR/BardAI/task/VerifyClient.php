<?php

declare(strict_types=1);

namespace TaylorR\BardAI\task;

use pocketmine\scheduler\AsyncTask;
use TaylorR\BardAI\Loader;
use TaylorR\MeetBard\Bard;
use TaylorR\MeetBard\security\User;

class VerifyClient extends AsyncTask
{

    public function __construct(
        private string $token
    ){}

    public function onRun(): void
    {
        $user = new User($this->token);
        $client = new Bard($user);
        $this->setResult($client);
    }

    public function onCompletion(): void
    {
        $token = $this->getResult();
        Loader::getInstance()->setClient($token);
    }
}