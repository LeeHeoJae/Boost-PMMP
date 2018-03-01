<?php

namespace sabone;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\event\entity\EntityRegainHealthEvent;
class BoostTask extends Task{
	public function __construct(){
			}
	public function onRun($tick){
		foreach(Server::getInstance()->getOnlinePlayers() as $player){
			$food=$player->getFood();
			if($food>0.25){
				$food-=0.25;
				$player->setFood($food);
			}
			if($food>0){
				$player->heal(new EntityRegainHealthEvent($player,0.5,EntityRegainHealthEvent::CAUSE_CUSTOM));
				if($food>6){
					$player->heal(new EntityRegainHealthEvent($player,0.5,EntityRegainHealthEvent::CAUSE_CUSTOM));
				}
				if($food>15){
					$player->heal(new EntityRegainHealthEvent($player,0.5,EntityRegainHealthEvent::CAUSE_CUSTOM));
				}
			}
		}
	}
}