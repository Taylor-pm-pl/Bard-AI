<?php

declare(strict_types=1);

namespace TaylorR\BardAI\form;

use pocketmine\player\Player;
use TaylorR\BardAI\Loader;
use TaylorR\BardAI\task\BardProcess;
use TaylorR\BardAI\utils\Utils;
use Vecnavium\FormsUI\CustomForm;

class AskForm
{

    /**
     * @param Player $player
     * @return void
     */
    public static function send(Player $player): void
    {
        $form = new CustomForm(function (Player $player, ?array $data = null) {
            if ($data === null) {
                return;
            }
            $question = $data[1];
            if ($question === "") {
                $player->sendMessage("§cPlease enter a question.");
                return;
            }
            $player->sendTip("§aAsking BardAI...");
            $player->getServer()->getAsyncPool()->submitTask(
                new BardProcess(
                    $player->getName(),
                    $question,
                    Loader::getInstance()->getBard()->getUser()
                )
            );
        });
        $form->setTitle(Utils::getForm("ask-form", "title"));
        $form->addLabel(Utils::getForm("ask-form", "label"));
        $form->addInput(Utils::getForm("ask-form", "input.text"), Utils::getForm("ask-form", "input.placeholder"));
        $player->sendForm($form);
    }
}