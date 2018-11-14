<?php

namespace xyz\bedition;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\Server;

class Boost extends PluginBase implements Listener{
	public function onEnable(){
		$this->getScheduler()->scheduleRepeatingTask(new BoostTask(),20);
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
	}
	public function onDamage(EntityDamageEvent $ev){
		$this->getLogger()->info($ev->getCause());
		$entity=$ev->getEntity();
		if($entity instanceof Player){
			$entity->sendMessage($ev->getCause());
		}
	}
	public function onRegen(EntityRegainHealthEvent $ev){
		$reason=$ev->getRegainReason();
		if($reason==CAUSE_SATURATION||$reason==CAUSE_REGEN||$reason==CAUSE_EATING){
			$ev->setCancelled();
		}
	}
	public function onExhaust(PlayerExhaustEvent $ev){
		if($ev->getCause()!=PlayerExhaustEvent::CAUSE_CUSTOM){
			$ev->setCancelled();
		}
	}
}