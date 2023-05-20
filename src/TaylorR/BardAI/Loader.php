<?php

declare(strict_types=1);

namespace TaylorR\BardAI;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use TaylorR\BardAI\commands\BardAI;
use TaylorR\BardAI\task\VerifyClient;
use TaylorR\MeetBard\Bard;

class Loader extends PluginBase
{

    use SingletonTrait;

    protected ?Bard $client = null;

    protected function onEnable(): void
    {
        self::setInstance($this);
        $this->saveDefaultConfig();
        $config = $this->getConfig()->getAll();
        $this->getServer()->getAsyncPool()->submitTask(new VerifyClient($config["token"]));
        $this->getServer()->getCommandMap()->register("bardai", new BardAI());
    }

    public function setBard(Bard $client): void
    {
        $this->client = $client;
    }

    public function getBard(): ?Bard
    {
        return $this->client;
    }

    public function isReady(): bool
    {
        return $this->getBard() instanceof Bard && $this->getBard()->isValid();
    }
}