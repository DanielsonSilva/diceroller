<?php
namespace danielsonsilva\DiceRoller\Tests;

require_once(__DIR__ . '\\..\\vendor\\autoload.php');

use PHPUnit\Framework\TestCase;
use danielsonsilva\DiceRoller\DiceRoller;

final class DiceRollingTest extends TestCase
{
    public function testRollSameDie(): void
    {
        $dice = new DiceRoller();
        $dice->addDice(3, 4);
        $value = $dice->roll();
        $this->assertTrue(3 <= $value && $value <= 12);
    }

    public function testRollWithPositiveModifier(): void
    {
        $dice = new DiceRoller();
        $dice->addDice(2, 6);
        $dice->addValue(5);
        $value = $dice->roll();
        $this->assertTrue(7 <= $value && $value <= 17);
    }

    public function testRollWithNegativeModifier(): void
    {
        $dice = new DiceRoller();
        $dice->addDice(2, 6);
        $dice->subtractValue(2);
        $value = $dice->roll();
        $this->assertTrue(0 <= $value && $value <= 10);
    }
}