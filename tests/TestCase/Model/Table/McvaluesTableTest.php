<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\McvaluesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\McvaluesTable Test Case
 */
class McvaluesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\McvaluesTable
     */
    public $Mcvalues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.mcvalues'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Mcvalues') ? [] : ['className' => 'App\Model\Table\McvaluesTable'];
        $this->Mcvalues = TableRegistry::get('Mcvalues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Mcvalues);

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
}
