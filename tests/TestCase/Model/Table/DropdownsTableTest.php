<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DropdownsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DropdownsTable Test Case
 */
class DropdownsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DropdownsTable
     */
    public $Dropdowns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dropdowns'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dropdowns') ? [] : ['className' => 'App\Model\Table\DropdownsTable'];
        $this->Dropdowns = TableRegistry::get('Dropdowns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dropdowns);

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
