<?php

namespace xyz\bedition;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityRegainHealthEvent as ERH;
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
	public function onRegen(ERH $ev){
		$reason=$ev->getRegainReason();
		if($reason==ERH::CAUSE_SATURATION||$reason==ERH::CAUSE_REGEN||$reason==ERH::CAUSE_EATING){
			$ev->setCancelled();
		}
	}
	public function onExhaust(PlayerExhaustEvent $ev){
		if($ev->getCause()!=PlayerExhaustEvent::CAUSE_CUSTOM){
			$ev->setCancelled();
		}
	}
}