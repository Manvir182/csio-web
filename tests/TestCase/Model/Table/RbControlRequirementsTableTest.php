<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RbControlRequirementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RbControlRequirementsTable Test Case
 */
class RbControlRequirementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RbControlRequirementsTable
     */
    public $RbControlRequirements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RbControlRequirements',
        'app.RbControls'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RbControlRequirements') ? [] : ['className' => RbControlRequirementsTable::class];
        $this->RbControlRequirements = TableRegistry::getTableLocator()->get('RbControlRequirements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RbControlRequirements);

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
