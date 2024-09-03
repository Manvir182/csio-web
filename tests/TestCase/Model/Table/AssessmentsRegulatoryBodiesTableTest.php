<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssessmentsRegulatoryBodiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssessmentsRegulatoryBodiesTable Test Case
 */
class AssessmentsRegulatoryBodiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AssessmentsRegulatoryBodiesTable
     */
    public $AssessmentsRegulatoryBodies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.AssessmentsRegulatoryBodies',
        'app.Assessments',
        'app.RegulatoryBodies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AssessmentsRegulatoryBodies') ? [] : ['className' => AssessmentsRegulatoryBodiesTable::class];
        $this->AssessmentsRegulatoryBodies = TableRegistry::getTableLocator()->get('AssessmentsRegulatoryBodies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssessmentsRegulatoryBodies);

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
