<?php

declare(strict_types=1);

namespace TaylorR\BardAI;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use TaylorR\BardAI\task\VerifyClient;
use TaylorR\MeetBard\Bard;
use TaylorR\MeetBard\security\User;

class Loader extends PluginBase
{

    use SingletonTrait;

    protected ?Bard $client = null;

    private array $config = [];

    protected function onEnable(): void
    {
        self::setInstance($this);
        $this->saveDefaultConfig();
        $this->config = $this->getConfig()->getAll();
        $this->getServer()->getAsyncPool()->submitTask(new VerifyClient($this->config["token"]));
    }

    public function setClient(Bard $client): void
    {
        $this->client = $client;
    }

    public function isReady(): bool
    {
        return $this->client instanceof Bard && $this->client->isValid();
    }
}