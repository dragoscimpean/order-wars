<?php

use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase {
    public function testCharactersHaveAllRequiredPropertiesWhenSpawning(){
        $charactersService = new \App\Services\CharactersService();
        list($orderus, $beast) = $charactersService->updateOrCreate();

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
}