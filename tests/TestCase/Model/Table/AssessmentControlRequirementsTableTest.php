<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssessmentControlRequirementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssessmentControlRequirementsTable Test Case
 */
class AssessmentControlRequirementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AssessmentControlRequirementsTable
     */
    public $AssessmentControlRequirements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.AssessmentControlRequirements',
        'app.AssessmentControls',
        'app.AcrStatuses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AssessmentControlRequirements') ? [] : ['className' => AssessmentControlRequirementsTable::class];
        $this->AssessmentControlRequirements = TableRegistry::getTableLocator()->get('AssessmentControlRequirements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssessmentControlRequirements);

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
