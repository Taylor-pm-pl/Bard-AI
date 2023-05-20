<?php

declare(strict_types=1);

namespace TaylorR\BardAI\utils;

use pocketmine\utils\TextFormat;
use TaylorR\BardAI\Loader;

class Utils
{
    public static function getMsg(string $type): string
    {
        $msg = Loader::getInstance()->getConfig()->getNested("messages." . $type) ?? "§cMessage not found.";
        return TextFormat::colorize($msg);
    }

    public static function getForm(string $form, string $key): string
    {
        $string = Loader::getInstance()->getConfig()->getNested($form . "." . $key) ?? "§cConfig not found.";
        return TextFormat::colorize($string);
    }
}