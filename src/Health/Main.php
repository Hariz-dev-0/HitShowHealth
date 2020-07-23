<?php

namespace Hit;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\level\particle\HugeExplodeSeedParticle;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\math\Vector3;
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
      switch($cause) {
        case EntityDamageEvent::CAUSE_ENTITY_ATTACK:
          $dmg = $ev->getDamager();
          $entity = $ev->getEntity();
          if($dmg instanceof Player and $entity instanceof Player) {
            $level = $entity->getLevel();
            $x = $entity->getX();
            $y = $entity->getY(0.5);
            $z = $entity->getZ();
            $pos = new Vector3($x, $y, $z);
            $level->addParticle(new HugeExplodeSeedParticle($pos));
          }
        break;
      } 
    }
}
