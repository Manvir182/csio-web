<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GenControlsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GenControlsTable Test Case
 */
class GenControlsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GenControlsTable
     */
    public $GenControls;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.GenControls',
        'app.RegulatoryBodies',
        'app.GenControlRequirements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GenControls') ? [] : ['className' => GenControlsTable::class];
        $this->GenControls = TableRegistry::getTableLocator()->get('GenControls', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GenControls);

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
