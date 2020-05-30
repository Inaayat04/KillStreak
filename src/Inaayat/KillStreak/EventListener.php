<?php

namespace Inaayat\KillStreak;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;

class EventListener implements Listener {

    public $plugin;

    public function __construct(KillStreak $plugin){
        $this->plugin = $plugin;
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        if(!$this->plugin->getProvider()->playerExists($player)){
            $this->plugin->getProvider()->registerPlayer($player);
        }
    }

    public function onPlayerKill(PlayerDeathEvent $event){
        $player = $event->getPlayer();
        if($player instanceof Player){
            $this->plugin->getProvider()->resetKSPoints($player);
        }
        $cause = $player->getLastDamageCause();
        if($cause instanceof EntityDamageByEntityEvent){
            $d = $cause->getDamager();
            if($d instanceof Player){
                $this->plugin->getProvider()->addKSPoints($d, (int)"1");
            }
        }
    }
}
