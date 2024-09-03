<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssessmentRisksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssessmentRisksTable Test Case
 */
class AssessmentRisksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AssessmentRisksTable
     */
    public $AssessmentRisks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.AssessmentRisks',
        'app.Assessments',
        'app.RcMappings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AssessmentRisks') ? [] : ['className' => AssessmentRisksTable::class];
        $this->AssessmentRisks = TableRegistry::getTableLocator()->get('AssessmentRisks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssessmentRisks);

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
