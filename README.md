# Dice Roller Package
Were you searching for an easy way to roll that dice with PHP? Well, you've found the right package for you.
You'll have the object representation to add rolls and modify them. Create, add rolls and roll to know the results.

It is as simples as this:

```
// Create your object
$diceRoller = new DiceRoller();

// Add dice into the roller
$dice->addDice(3, 4); // adds 3 d4 dice
$dice->addDice(1, 20); // adds 1 d20 die

// Apply modifier if you wish
$dice->addValue(5); // adds a +5 into the roll

// Then roll to know the results
$rollResult = $dice->roll();
``` 

Now you can use as a package and do some dice rolling.