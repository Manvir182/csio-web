<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RcMappingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RcMappingsTable Test Case
 */
class RcMappingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RcMappingsTable
     */
    public $RcMappings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RcMappings',
        'app.AssessmentRisks',
        'app.AssessmentControls'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RcMappings') ? [] : ['className' => RcMappingsTable::class];
        $this->RcMappings = TableRegistry::getTableLocator()->get('RcMappings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RcMappings);

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
