<?php

namespace Inaayat\provider;

use pocketmine\Player;

interface ProviderInterface {

    public function prepare(): void;

    public function registerPlayer(Player $player): void;

    public function addKSPoints(Player $player, int $points = 1): void;

    public function playerExists(Player $player): bool;

    public function getPlayerKSPoints(Player $player): int;

    public function resetKSPoints(Player $player);

    public function close(): void;
    
}
