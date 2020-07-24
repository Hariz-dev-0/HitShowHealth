<?php

namespace Health;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;

class Main extends PluginBase implements Listener{

   public function onEnable(){
        $this->getLogger()->warning("§aPlugin Has Work");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
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
                    $health = $entity->getHealth();
                    $name = $entity->getName();
                    $maxHealth = $entity->getMaxHealth();
                     $dmg->sendMessage("§eHealth §a{$name} §4[§e{$health}/{$maxHealth}§4]§c♥");
                }
            break;
            case EntityDamageEvent::CAUSE_PROJECTILE:
                $dmg = $ev->getDamager();
                $entity = $ev->getEntity();
                if($dmg instanceof Player and $entity instanceof Player){
                    $health = $entity->getHealth();
                    $name = $entity->getName();
                    $maxHealth = $entity->getMaxHealth();
                     $dmg->sendMessage("§eHealth §a{$name} §4[§e{$health}/{$maxHealth}§4]§c♥");
                 }
             break;
        }
    }
}
