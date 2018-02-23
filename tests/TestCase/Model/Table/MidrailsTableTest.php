<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MidrailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MidrailsTable Test Case
 */
class MidrailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MidrailsTable
     */
    public $Midrails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.midrails',
        'app.quotes',
        'app.users',
        'app.products'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Midrails') ? [] : ['className' => 'App\Model\Table\MidrailsTable'];
        $this->Midrails = TableRegistry::get('Midrails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Midrails);

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
