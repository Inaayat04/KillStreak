# KillStreak

* KillSteak plugin for pocketmine.
* Get 1 point when kill a player.
* When you died the point return to 0.
* There an API for developers.
[![](https://poggit.pmmp.io/shield.state/KillStreak)](https://poggit.pmmp.io/p/KillStreak)

## How to Install?

* Put the plugin to you're /plugins folder.
* Restart you're server.
* and done Enjoy.

### API:

```php
 <?php
 use Inaayat\KillStreak;
 ```
 
## You can create an instance by doing:
```php
$ks = KillStreak::getInstance();
```
 
### check the player killstreak by:
```php
$ks->getProvider()->getPlayerKSPoints($player);
```

### add killstreak to player by:
```php
$ks->getProvider()->addKSPoints($player, "1");
```

### reset the player killstreak by:
```php
$ks->getProvider()->resetKSPoints($player);
```

# This API was made with 💓 by Inaayat.
# Credit: JackMD.
