<?php

namespace Doma\StopReason;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class StopReason extends PluginBase {

    private static StopReason $instance;
    private Config $config;

    public function onEnable(): void
    {
        self::$instance = $this;
        $this->saveDefaultConfig();
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->getLogger()->info(TextFormat::GREEN . "StopReason plugin enabled.");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if (count($args) < 1) {
            $sender->sendMessage(TextFormat::RED . "Usage: /stopreason <reason>");
            return true;
        }

        $this->stop(implode(" ", $args));
        return true;
    }

    public static function getInstance(): self {
        return self::$instance;
    }

    public function getFormat(): string {
        return $this->config->get("format", "Server Stopped{line}Reason: {reason}}");
    }

    public function setFormat(string $format): void {
        $this->config->set("format", $format);
        $this->config->save();
    }

    public function getType(): string {
        return $this->config->get("type", "kick");
    }

    public function setType(string $type): void {
        $this->config->set("type", $type);
        $this->config->save();
    }

    public function stop(string $reason): void
    {
        $type = $this->getType();
        $format = $this->getFormat();
        $format = str_replace("{line}", "\n", $format);
        $format = str_replace("{reason}", $reason, $format);

        foreach ($this->getServer()->getOnlinePlayers() as $player) {
            if ($type === "kick") {
                $player->kick($format);
            } elseif ($type === "message") {
                $player->sendMessage($format);
            }
        }

        $this->getLogger()->info("Server Stopped{line}Reason: {reason}" . $reason);
        $this->getServer()->shutdown();
    }
}