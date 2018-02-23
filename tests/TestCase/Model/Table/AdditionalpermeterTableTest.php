<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdditionalpermeterTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdditionalpermeterTable Test Case
 */
class AdditionalpermeterTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AdditionalpermeterTable
     */
    public $Additionalpermeter;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.additionalpermeter',
        'app.quotes',
        'app.users',
        'app.products',
        'app.midrails'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Additionalpermeter') ? [] : ['className' => 'App\Model\Table\AdditionalpermeterTable'];
        $this->Additionalpermeter = TableRegistry::get('Additionalpermeter', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Additionalpermeter);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
