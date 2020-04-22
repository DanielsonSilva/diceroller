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
     * will get the result from the roll
     * @return int Result from the roll, positive different from zero integers returned
     */
    public function roll(): int
    {
        if (empty($this->diceAdded)) {
            return 0;
        }
        $sum = 0;
        foreach ($this->diceAdded as $die) {
            $sum += $die->roll();
        }
        $result = $sum + $this->modifier;
        if ($result <= 0) {
            return 1;
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
        $this->modifier -= -abs($number);
    }
}