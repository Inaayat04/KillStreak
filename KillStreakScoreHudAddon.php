<?php
declare(strict_types = 1);

/**
 * @name KillStreakAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\KillStreakAddon
 * @depend KillStreak
 */
namespace JackMD\ScoreHud\Addons
{

	use JackMD\ScoreHud\addon\AddonBase;
	use Inaayatt\KillStreak;
	use pocketmine\Player;

	class KillStreakAddon extends AddonBase{

		/** @var KillStreak */
		private $KillStreak;

		public function onEnable(): void{
			$this->KillStreak = $this->getServer()->getPluginManager()->getPlugin("KillStreak");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{killstreak}"       => $this->getPlayerKS($player)
			];
		}

		/**
		 * @param Player $player
		 * @return string
		 */
		public function getPlayerKS(Player $player){
			$ks = $this->KillStreak;
			$ks->getProvider()->getPlayerKSPoints($player);
		}
	}
}
