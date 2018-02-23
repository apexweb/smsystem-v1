<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomitemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomitemsTable Test Case
 */
class CustomitemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomitemsTable
     */
    public $Customitems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.customitems',
        'app.quotes',
        'app.users',
        'app.products',
        'app.midrails',
        'app.additionalpermeters',
        'app.additionalperlength'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Customitems') ? [] : ['className' => 'App\Model\Table\CustomitemsTable'];
        $this->Customitems = TableRegistry::get('Customitems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Customitems);

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
