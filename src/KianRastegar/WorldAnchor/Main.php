<?php

namespace KianRastegar\WorldAnchor;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\player\Player;
use pocketmine\world\Position;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{
    private array $safePositions = [];
    private Config $config;

    public function onEnable(): void
    {
        $this->saveDefaultConfig();
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);

        $this->reloadConfig();

        $positions = $this->getConfig()->get("safe_positions", []);
        if (is_array($positions)) {
            foreach ($positions as $key => $pos) {
                if (isset($pos["world"], $pos["x"], $pos["y"], $pos["z"])) {
                    $this->safePositions[$key] = [
                        "world" => $pos["world"],
                        "x" => $pos["x"],
                        "y" => $pos["y"],
                        "z" => $pos["z"]
                    ];
                }
            }
        }

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("WorldAnchor enabled!");
    }

    public function onPlayerMove(PlayerMoveEvent $event): void
    {
        $player = $event->getPlayer();
        $worldName = $player->getWorld()->getFolderName();

        foreach ($this->safePositions as $key => $pos) {
            if ($worldName === $pos["world"]) {
                $world = $this->getServer()->getWorldManager()->getWorldByName($pos["world"]);
                if ($world !== null && $player->getPosition()->getY() < 1) {
                    $safePos = new Position($pos["x"], $pos["y"], $pos["z"], $world);
                    $player->teleport($safePos);
                }
                break;
            }
        }
    }
}