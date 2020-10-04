<?php

use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase {
    private $service;

    public function setUp(): void
    {
        $this->service = new \App\Services\CharactersService();
    }

    public function testCharactersHaveAllRequiredPropertiesWhenSpawning() {

        list($orderus, $beast) = $this->service->updateOrCreate();

        $this->assertClassHasAttribute('health', get_class($orderus));
        $this->assertClassHasAttribute('strength', get_class($orderus));
        $this->assertClassHasAttribute('defence', get_class($orderus));
        $this->assertClassHasAttribute('speed', get_class($orderus));
        $this->assertClassHasAttribute('luck', get_class($orderus));

        $this->assertClassHasAttribute('health', get_class($beast));
        $this->assertClassHasAttribute('strength', get_class($beast));
        $this->assertClassHasAttribute('defence', get_class($beast));
        $this->assertClassHasAttribute('speed', get_class($beast));
        $this->assertClassHasAttribute('luck', get_class($beast));
    }

    public function testCharacterCanGetItsPropertiesUpdated() {
        $mockedOrderus = [
            'health' => 50,
            'strength' => 51,
            'defence' => 52,
            'speed' => 53,
            'luck' => 54,
        ];

        $mockedBeast = [
            'health' => 60,
            'strength' => 61,
            'defence' => 62,
            'speed' => 63,
            'luck' => 64,
        ];

        list($orderus, $beast) = $this->service->updateOrCreate($mockedOrderus, $mockedBeast);

        $this->assertEquals(50, $orderus->health);
        $this->assertEquals(51, $orderus->strength);
        $this->assertEquals(52, $orderus->defence);
        $this->assertEquals(53, $orderus->speed);
        $this->assertEquals(54, $orderus->luck);

        $this->assertEquals(60, $beast->health);
        $this->assertEquals(61, $beast->strength);
        $this->assertEquals(62, $beast->defence);
        $this->assertEquals(63, $beast->speed);
        $this->assertEquals(64, $beast->luck);
    }

    public function testOnMatchStartTheCorrectCharacterWithRandomStatsIsChoosenToStrikeFirst() {
        list($orderus, $beast) = $this->service->updateOrCreate();
        $attacker = $this->service->getAttacker() === 'Orderus'  ? $orderus : $beast;

        if ($orderus->speed <> $beast->speed) {
            $fastest = $orderus->speed > $beast->speed ? $orderus : $beast;
            $this->assertEquals($fastest, $attacker);
            return;
        }

        $luckiest = $orderus->luck > $beast->luck ? $orderus : $beast;
        $this->assertEquals($luckiest, $attacker);
    }

    public function testOnMatchStartTheFastestIsChoosenToStrikeFirst() {
        $mockedOrderus = [
            'health' => 50,
            'strength' => 70,
            'defence' => 50,
            'speed' => 50,
            'luck' => 50,
        ];

        $mockedBeast = [
            'health' => 60,
            'strength' => 60,
            'defence' => 60,
            'speed' => 60,
            'luck' => 60,
        ];

        list($orderus, $beast) = $this->service->updateOrCreate($mockedOrderus, $mockedBeast);
        $attacker = $this->service->getAttacker() === 'Orderus'  ? $orderus : $beast;

        $this->assertEquals($beast, $attacker);
    }

    public function testOnMatchStartTheLuckiestIsChoosenToStrikeFirst() {
        $mockedOrderus = [
            'health' => 50,
            'strength' => 70,
            'defence' => 50,
            'speed' => 50,
            'luck' => 60,
        ];

        $mockedBeast = [
            'health' => 60,
            'strength' => 60,
            'defence' => 60,
            'speed' => 50,
            'luck' => 50,
        ];

        list($orderus, $beast) = $this->service->updateOrCreate($mockedOrderus, $mockedBeast);
        $luckiest = $orderus->luck > $beast->luck ? $orderus : $beast;

        $this->assertEquals($luckiest, $orderus);
    }

    public function testTheCorrectCharacterIsChosenToBeTheAttackerAfterItWasTheDefender() {
        $mockedOrderus = [
            'health' => 50,
            'strength' => 70,
            'defence' => 50,
            'speed' => 50,
            'luck' => 60,
        ];

        $mockedBeast = [
            'health' => 60,
            'strength' => 60,
            'defence' => 60,
            'speed' => 50,
            'luck' => 50,
        ];

        list($orderus, $beast) = $this->service->updateOrCreate($mockedOrderus, $mockedBeast);
        $beastIsNextAttacker = $this->service->getAttacker($orderus->name);
        $orderusIsNextAttacker = $this->service->getAttacker($beast->name);

        $this->assertEquals($orderusIsNextAttacker, 'Orderus');
        $this->assertEquals($beastIsNextAttacker, 'Beast');
    }

    public function testCharacterCanTakeDamage() {
        $mockedOrderus = [
            'health' => 50,
            'strength' => 70,
            'defence' => 50,
            'speed' => 50,
            'luck' => 50,
        ];

        $mockedBeast = [
            'health' => 60,
            'strength' => 60,
            'defence' => 60,
            'speed' => 60,
            'luck' => 60,
        ];

        list($orderus, $beast) = $this->service->updateOrCreate($mockedOrderus, $mockedBeast);

        $beastDamageTook = $beast->takeDamage($orderus);
        $orderusDamageTook = $orderus->takeDamage($beast);

        $this->assertEquals(10, $beastDamageTook);
        // 10 is the normal damage, 5 is the damage took if the magic shield activated
        $this->assertContains($orderusDamageTook, [10, 5]);
    }

    public function testCharacterCanAttack() {
        $mockedOrderus = [
            'health' => 50,
            'strength' => 70,
            'defence' => 50,
            'speed' => 50,
            'luck' => 50,
        ];

        $mockedBeast = [
            'health' => 60,
            'strength' => 60,
            'defence' => 60,
            'speed' => 60,
            'luck' => 60,
        ];

        list($orderus, $beast) = $this->service->updateOrCreate($mockedOrderus, $mockedBeast);

        $orderusInflictedDamage = $orderus->attack($beast);
        $beastInflictedDamage = $beast->attack($orderus);

        // 10 is the normal damage, 20 is the damage done in case Rapid Strike skill gets activated
        $this->assertContains($orderusInflictedDamage, [10, 20]);
        // 10 is the normal damage, 5 is the damage took if the magic shield activated
        $this->assertContains($beastInflictedDamage, [10, 5]);
    }
}