<?php

namespace TaylorR\BardAI\form;

use pocketmine\player\Player;
use TaylorR\BardAI\utils\Utils;
use Vecnavium\FormsUI\SimpleForm;

class ResultForm
{

    public static function send(Player $player, string $content): void
    {
        $form = new SimpleForm(function (Player $player, ?int $data = null) {
            if ($data === null) {
                return;
            }
        });
        $form->setTitle(Utils::getForm("result-form", "title"));
        $form->setContent(str_replace("{content}", $content, Utils::getForm("result-form", "content")));
        $form->addButton(Utils::getForm("result-form", "button"));
        $player->sendForm($form);
    }
}