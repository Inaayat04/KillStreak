<?php

namespace Inaayat\KillStreak;

use Inaayat\KillStreak\provider\ProviderInterface;
use Inaayat\KillStreak\provider\SQLiteProvider;
use pocketmine\plugin\PluginBase;

class KillStreak extends PluginBase{

    private static $instance;
    private $provider;

    public static function getInstance(): KillStreak{
        return self::$instance;
    }

    public function onLoad(): void{
        self::$instance = $this;
    }

    public function onEnable(): void{
        $provider = new SQLiteProvider();
        if($provider instanceof ProviderInterface){
            $this->provider = $provider;
        }
        $this->saveDefaultConfig();
        $this->getProvider()->prepare();
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }


    public function onDisable(){
        $this->getProvider()->close();
    }

    public function getProvider(): ProviderInterface{
        return $this->provider;
    }
}
