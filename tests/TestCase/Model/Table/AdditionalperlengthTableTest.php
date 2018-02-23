<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdditionalperlengthTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdditionalperlengthTable Test Case
 */
class AdditionalperlengthTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AdditionalperlengthTable
     */
    public $Additionalperlength;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.additionalperlength',
        'app.quotes',
        'app.users',
        'app.products',
        'app.midrails',
        'app.additionalpermeters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Additionalperlength') ? [] : ['className' => 'App\Model\Table\AdditionalperlengthTable'];
        $this->Additionalperlength = TableRegistry::get('Additionalperlength', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Additionalperlength);

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
