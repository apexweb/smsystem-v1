<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdditionalpermetersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdditionalpermetersTable Test Case
 */
class AdditionalpermetersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AdditionalpermetersTable
     */
    public $Additionalpermeters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.additionalpermeters',
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
        $config = TableRegistry::exists('Additionalpermeters') ? [] : ['className' => 'App\Model\Table\AdditionalpermetersTable'];
        $this->Additionalpermeters = TableRegistry::get('Additionalpermeters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Additionalpermeters);

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
