<?php

declare(strict_types=1);

namespace TaylorR\BardAI\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use TaylorR\BardAI\form\AskForm;
use TaylorR\BardAI\Loader;
use TaylorR\BardAI\utils\Utils;

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
        if (!$this->testPermission($sender)) {
            $sender->sendMessage(Utils::getMsg("no-permission"));
            return;
        }

        if (!Loader::getInstance()->isReady()) {
            $sender->sendMessage(Utils::getMsg("not-ready"));
            return;
        }

        if (!$sender instanceof Player) {
            $sender->sendMessage(Utils::getMsg("player-only"));
            return;
        }
        AskForm::send($sender);
    }

    /**
     * @return Plugin
     */
    public function getOwningPlugin(): Plugin
    {
        return Loader::getInstance();
    }
}