<?php

namespace Inaayat\provider;

use Inaayat\KillStreak;
use pocketmine\Player;

class SQLiteProvider implements ProviderInterface {

    /** @var \SQLite3 */
    public $killstreakdb;

    public function prepare(): void{
        $this->killstreakdb = new \SQLite3(KillStreak::getInstance()->getDataFolder() . "killstreak.db");
        $this->killstreakdb->exec("CREATE TABLE IF NOT EXISTS master (player TEXT PRIMARY KEY COLLATE NOCASE, ks INT)");
    }

    public function registerPlayer(Player $player): void{
        $stmt = $this->killstreakdb->prepare("INSERT OR REPLACE INTO master (player, ks) VALUES (:player, :ks)");
        $stmt->bindValue(":player", $player->getLowerCaseName());
        $stmt->bindValue(":ks", "0");
        $stmt->execute();
    }

    public function addKSPoints(Player $player, int $points = 1): void{
        $stmt = $this->killstreakdb->prepare("INSERT OR REPLACE INTO master (player, ks) VALUES (:player, :ks)");
        $stmt->bindValue(":player", $player->getLowerCaseName());
        $stmt->bindValue(":ks", $this->getPlayerKSPoints($player) + $points);
        $stmt->execute();
    }

    public function resetKSPoints(Player $player){
        $stmt = $this->killstreakdb->prepare("INSERT OR REPLACE INTO master (player, ks) VALUES (:player, :ks)");
        $stmt->bindValue(":player", $player->getLowerCaseName());
        $stmt->bindValue(":ks", "0");
        $stmt->execute();
    }

    public function playerExists(Player $player): bool{
        $playerName = $player->getLowerCaseName();
        $result = $this->killstreakdb->query("SELECT player FROM master WHERE player='$playerName';");
        $array = $result->fetchArray(SQLITE3_ASSOC);
        return empty($array) == false;
    }

    public function getPlayerKSPoints(Player $player): int{
        $playerName = $player->getLowerCaseName();
        $result = $this->killstreakdb->query("SELECT ks FROM master WHERE player = '$playerName'");
        $resultArray = $result->fetchArray(SQLITE3_ASSOC);
        return (int) $resultArray["ks"];
    }

    public function close(): void{
        $this->killstreakdb->close();
    }
}
