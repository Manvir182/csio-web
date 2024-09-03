<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RbControlsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RbControlsTable Test Case
 */
class RbControlsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RbControlsTable
     */
    public $RbControls;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RbControls',
        'app.RegulatoryBodies',
        'app.RbControlRequirements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RbControls') ? [] : ['className' => RbControlsTable::class];
        $this->RbControls = TableRegistry::getTableLocator()->get('RbControls', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RbControls);

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
