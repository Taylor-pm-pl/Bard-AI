<?php

declare(strict_types=1);

namespace TaylorR\BardAI\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use TaylorR\BardAI\Loader;

class BardAI extends Command implements PluginOwned
{

    public function __construct()
    {
        parent::__construct("bardai", "BardAI command", "/bardai");
        $this->setPermission('bardai.command');
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if (!$this->testPermission($sender)) return;
        if (!Loader::getInstance()->isReady()) {
            $sender->sendMessage("§cBardAI is not ready yet!");
            return;
        }

    }

    /**
     * @return Plugin
     */
    public function getOwningPlugin(): Plugin
    {
        return Loader::getInstance();
    }
}