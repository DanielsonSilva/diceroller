<?php


namespace danielsonsilva\DiceRoller;

/**
 * Class DiceRoller
 * @package danielsonsilva\DiceRoller
 * Class to represent rolling one or more several dice and get the results from that roll
 * The roll can add several types of die and add or subtract values to modify the result
 */
class DiceRoller
{
    /** @var array The dice that a singular roll will have */
    private array $diceAdded;

    /** @var int The modifier from this roll */
    private int $modifier;

    /**
     * DiceRoller constructor
     *
     * This constructor will create an empty object with no modifier and no dice
     */
    public function __construct()
    {
        $this->diceAdded = [];
        $this->modifier = 0;
    }

    /**
     * After all the dice are added and the modifier is set, then this function
     * will get the result from the roll.
     * The minimum roll result is number 0
     * @return int Result from the roll, positive different from zero integers returned
     */
    public function roll(): int
    {
        $result = 0;
        if (!empty($this->diceAdded) || $this->modifier != 0) {
            foreach ($this->diceAdded as $die) {
                $result += $die->roll();
            }
            $result += $this->modifier;
            if ($result <= 0) {
                return 1;
            }
        }
        return $result;
    }

    /**
     * Function to add dice into the roll, choosing the number of sides and how many dice the
     * roll will have
     * @param int $numberOfDice Number of dice to be added into the roll
     * @param int $numberOfSides Number of sides of the dice that will be added now
     * @return int 1 if the die was added, and 0 otherwise
     */
    public function addDice(int $numberOfDice, int $numberOfSides): int
    {
        try {
            for ($i = 0; $i < $numberOfDice; $i++) {
                $this->diceAdded[] = new OneDie($numberOfSides);
            }
        } catch (Exception $e) {
            print_r($e);
            return 0;
        }
        return 1;
    }

    /**
     * Function to add the modifier by certain value
     * @param int $number Modifier to sum
     */
    public function addValue(int $number): void
    {
        $this->modifier += abs($number);
    }

    /**
     * Function to subtract the modifier by certain value
     * @param int $number Modifier to subtracted
     */
    public function subtractValue(int $number): void
    {
        $this->modifier -= abs($number);
    }

    /**
     * Returns a string representation of the object
     * @return string Representation of the object
     */
    public function __toString(): string
    {
        $string = "";
        if (!empty($this->diceAdded) || $this->modifier != 0) {
            $diceArray = $this->getDiceQuantity();
            uksort($diceArray, array($this, "CompareDice"));
            $diceString = $this->printDices($diceArray);
            $modifierString = $this->addTextModifier(empty($diceString));
            $string = $diceString . $modifierString;
        }
        return $string;
    }

    /**
     * Function to compare two dice
     * @param OneDie $die1 First die to compare
     * @param OneDie $die2 Second die to compare
     * @return int If $die1 is lower than $die2, the function returns -1, if $die1 is greater than $die2, the function
     *  returns 1 and if they are equal then the function returns 0
     */
    private function CompareDice($die1, $die2): int
    {
        return $die1 <=> $die2;
    }

    /**
     * Transform the dice array into a string representation
     * @param array $diceArray Array of dices with their quantity [Onedie => quantity]
     * @return string Text representation of the dice
     */
    private function printDices(array $diceArray): string
    {
        $string = "";
        foreach ($diceArray as $die => $quantity) {
            $dieText = new OneDie($die);
            $string .= $quantity . strval($dieText) . " + ";
        }
        return substr($string, 0, -3);
    }

    /**
     * Function that gets the dice and their quantity in current roll
     * @return array Return the array [OneDie $die => quantity in the roll]
     */
    private function getDiceQuantity(): array
    {
        $diceArray = [];
        foreach ($this->diceAdded as $die) {
            $sides = $die->getNumberOfSides();
            if (array_key_exists($sides, $diceArray)) {
                $diceArray[$sides]++;
            } else {
                $diceArray[$sides] = 1;
            }
        }
        return $diceArray;
    }

    /**
     * Check the modifier from this roll and print into text representation
     * @param bool True if the modifier is the only thing in the roller, False otherwise
     * @return string Text representation of the modifier
     */
    private function addTextModifier(bool $only): string
    {
        $string = "";
        $number = abs($this->modifier);
        switch ($this->modifier <=> 0) {
            case 1:
                $string .= ($only ? $number : " + " . $number);
                break;
            case -1:
                $string .= ($only ? "- " . $number : " - " . $number);
                break;
            default:
                break;
        }
        return $string;
    }

    /**
     * Check if the dice roll is empty or the roll has some dice
     * @return bool True if the dice roll is empty, False otherwise
     */
    public function isEmpty(): bool
    {
        return (empty($this->diceAdded));
    }

    /**
     * Set the modifier into certain number
     * @param int $value Value to set the modifier into some value
     */
    public function setModifier(int $value): void
    {
        $this->modifier = $value;
    }

    /**
     * Get the modifier from the dice roll
     * @return int Actual modifier
     */
    public function getModifier(): int
    {
        return $this->modifier;
    }

}