<?php
namespace danielsonsilva\DiceRoller\Tests;

require_once(__DIR__ . '\\..\\vendor\\autoload.php');

use PHPUnit\Framework\TestCase;
use danielsonsilva\DiceRoller\DiceRoller;

final class DiceRollingTest extends TestCase
{
    /**
     * @var int Set the number of rolls to test the minimum and maximum values
     */
    private $numberOfRolls = 1000000;

    public function testRollSameDie(): void
    {
        $dice = new DiceRoller();
        $dice->addDice(3, 4);
        $rolledResults = [];
        for ($i = 0; $i < $this->numberOfRolls; $i++) {
            $rolledResults[] = $dice->roll();
        }
        $minimumRoll = min($rolledResults);
        $maximumRoll = max($rolledResults);
        $this->assertGreaterThanOrEqual(3, $minimumRoll);
        $this->assertLessThanOrEqual(12, $maximumRoll);
    }

    public function testRollWithPositiveModifier(): void
    {
        $dice = new DiceRoller();
        $dice->addDice(2, 6);
        $dice->addValue(5);
        $rolledResults = [];
        for ($i = 0; $i < $this->numberOfRolls; $i++) {
            $rolledResults[] = $dice->roll();
        }
        $minimumRoll = min($rolledResults);
        $maximumRoll = max($rolledResults);
        $this->assertGreaterThanOrEqual(7, $minimumRoll);
        $this->assertLessThanOrEqual(17, $maximumRoll);
    }

    public function testRollWithNegativeModifier(): void
    {
        $dice = new DiceRoller();
        $dice->addDice(2, 6);
        $dice->subtractValue(5);
        $rolledResults = [];
        for ($i = 0; $i < $this->numberOfRolls; $i++) {
            $rolledResults[] = $dice->roll();
        }
        $minimumRoll = min($rolledResults);
        $maximumRoll = max($rolledResults);
        $this->assertGreaterThanOrEqual(0, $minimumRoll);
        $this->assertLessThanOrEqual(10, $maximumRoll);
        $this->assertTrue(0 <= $minimumRoll && $maximumRoll <= 7);
    }

    public function testRollTextRepresentation(): void
    {
        $dice = new DiceRoller();
        $dice->addDice(2, 6);
        $dice->subtractValue(2);
        $this->assertEquals("2d6 - 2", strval($dice));

        $dice = new DiceRoller();
        $dice->addDice(1, 6);
        $dice->addDice(1, 8);
        $dice->addDice(1, 10);
        $dice->addDice(1, 4);
        $dice->addDice(1, 10);
        $dice->addDice(1, 2);
        $dice->addDice(3, 10);
        $dice->addDice(1, 8);
        $dice->addDice(2, 6);
        $dice->subtractValue(5);
        $dice->subtractValue(5);
        $dice->addValue(7);
        $this->assertEquals("1d2 + 1d4 + 3d6 + 2d8 + 5d10 - 3", strval($dice));

        $dice = new DiceRoller();
        $dice->addValue(5);
        $this->assertEquals("5", strval($dice));

        $dice = new DiceRoller();
        $dice->addValue(3);
        $dice->subtractValue(12);
        $this->assertEquals("- 9", strval($dice));
    }

    public function testRollIsEmpty()
    {
        $dice = new DiceRoller();
        $dice->addDice(3, 4);
        $this->assertFalse($dice->isEmpty());
        $dice = new DiceRoller();
        $this->assertTrue($dice->isEmpty());
    }

    public function testSetModifiers()
    {
        $dice = new DiceRoller();
        $dice->addDice(1, 6);
        $dice->addValue(20);
        $dice->setModifier(2);
        $rolledResults = [];
        for ($i = 0; $i < $this->numberOfRolls; $i++) {
            $rolledResults[] = $dice->roll();
        }
        $minimumRoll = min($rolledResults);
        $maximumRoll = max($rolledResults);
        $this->assertGreaterThanOrEqual(3, $minimumRoll);
        $this->assertLessThanOrEqual(8, $maximumRoll);
    }
}