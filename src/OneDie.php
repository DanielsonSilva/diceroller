<?php


namespace danielsonsilva\DiceRoller;

/**
 * Class OneDie
 * @package danielsonsilva\DiceRoller
 * Represent only one die and its properties
 */
class OneDie
{
    /** @var int Represent the number of sides of this die */
    private int $numberOfSides;

    /**
     * Get the number of sides from a die
     * @return int Number of sides of this die
     */
    public function getNumberOfSides(): int
    {
        return $this->numberOfSides;
    }

    /**
     * OneDie constructor
     * The constructor only works passing the number of sides of this die
     * @param int $sides Number of sides of the die
     */
    public function __construct(int $sides)
    {
        $this->numberOfSides = $sides;
    }

    /**
     * Function that rolls the die and return a random number from the die
     * @return int Random value from 1 to the max of the die
     */
    public function roll(): int
    {
        return rand(1, $this->numberOfSides);
    }

    /**
     * String representation of the object
     */
    public function __toString()
    {
        return "d" . $this->numberOfSides;
    }
}