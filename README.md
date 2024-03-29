# Dice Roller Package
Were you searching for an easy way to roll that dice with PHP? Well, you've found the right package for you.
You'll have the object representation to add rolls and modify them. Create, add rolls and roll to know the results.

[Live Demo](http://danielsonsilva.tech/diceroller/)

It is as simples as this:

```
use danielsonsilva\DiceRoller\DiceRoller;

// Create your object
$diceRoller = new DiceRoller();

// Add dice into the roller
$dice->addDice(3, 4); // adds 3 d4 dice
$dice->addDice(1, 20); // adds 1 d20 die

// Apply modifier if you wish
$dice->addValue(5); // adds a +5 into the roll

// Or you can subtract from that added modifier
$dice->subtractValue(7); // the roll modifier becomes -2

// Then roll to know the results
$rollResult = $dice->roll();

// Get the string result, in this case could be
// 3d4 (2 + 1 + 4) + 1d20 (18)
$stringResult = $dice->getResultString();
```

Now you can use as a package and do some dice rolling.

# Version History

## v 1.4.1

- Tests were made in php 7.3.27

## v 1.4.0

- After the roll, a result string showing each result from each group dice
- Unit tests added to check the new features

## v 1.4.0

- After the roll, a result string showing each result from each group dice
- Unit tests added to check the new features

## v 1.3.0

- Downgraded the minimum version of PHP required to use this package from 7.4 to 7.3

## v 1.2.0

- Features added: isEmpty and set and get modifier to change the modifier completely;
- Unit tests added to check the new features.

## v 1.1.0

- Features added: string representation of the DiceRoller (__toString())
- Unit tests improved to check the minimum and maximum values from a roll

## v 1.0.0

- Package danielsonsilva/diceroller created;
- Features: roll, addDice, addValue and subtractValue;
- Unit tests to check its effectiveness
