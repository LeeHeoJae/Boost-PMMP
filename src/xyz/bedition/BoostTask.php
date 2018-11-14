<?php

namespace xyz\bedition;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\event\entity\EntityRegainHealthEvent as ERH;
class BoostTask extends Task{
	public function onRun($tick){
		foreach(Server::getInstance()->getOnlinePlayers() as $player){
			$food=$player->getFood();
			if($food>0.25){
				$food-=0.25;
				$player->setFood($food);
			}
			if($food>=1){
				$player->heal(new ERH($player,0.5,ERH::CAUSE_CUSTOM));
				if($food>6){
					$player->heal(new ERH($player,0.5,ERH::CAUSE_CUSTOM));
				}
				if($food>15){
					$player->heal(new ERH($player,0.5,ERH::CAUSE_CUSTOM));
				}
			}
		}
	}
}