<?php

namespace Health;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\utils\Config;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;

class Main extends PluginBase implements Listener{

   public function onEnable(){
        $this->getLogger()->warning("§aPlugin Has Work");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        
        @mkdir($this->getDataFolder());
	$this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }
    public function onLoad(){
        $this->getLogger()->warning("Plugin Has Loading");
    }
    public function onDisable(){
        $this->getLogger()->warning("Plugin Has Disable Plugin Error");
    }
    public function onHit(EntityDamageEvent $ev){
        $cause = $ev->getCause();
        switch($cause){
            case EntityDamageEvent::CAUSE_ENTITY_ATTACK:
                $dmg = $ev->getDamager();
                $entity = $ev->getEntity();
                if($dmg instanceof Player and $entity instanceof Player){
                	$level = $dmg->getLevel();
                    $health = $entity->getHealth();
                    $name = $entity->getName();
                    $playernamehit = $dmg->getName();
                    $maxHealth = $entity->getMaxHealth();
                    
                     $dmg->sendMessage(str_replace("{player-name}", $name, str_replace("{line}", "\n", str_replace("{health}", $health, str_replace("{maxhealth}", $maxHealth, $this->cfg->get("Player-Hit-Health"))))));
                     $level->broadcastLevelSoundEvent($dmg->getPosition(), LevelSoundEventPacket::SOUND_ATTACK_STRONG);
                }
            break;
            case EntityDamageEvent::CAUSE_PROJECTILE:
                $dmg = $ev->getDamager();
                $entity = $ev->getEntity();
                if($dmg instanceof Player and $entity instanceof Player){
                	$level = $dmg->getLevel();
                    $health = $entity->getHealth();
                    $name = $entity->getName();
                    $playernamehit = $dmg->getName();
                    $maxHealth = $entity->getMaxHealth();
                    
                     $dmg->sendMessage(str_replace("{player-name}", $name, str_replace("{line}", "\n", str_replace("{health}", $health, str_replace("{maxhealth}", $maxHealth, $this->cfg->get("Bow-Hit-Health"))))));
                     $level->broadcastLevelEvent($dmg->getPosition(), LevelEventPacket::EVENT_SOUND_ANVIL_FALL);
                }
            break;
        }
    }
}
