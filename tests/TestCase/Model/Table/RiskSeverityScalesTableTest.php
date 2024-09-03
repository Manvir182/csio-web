<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RiskSeverityScalesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RiskSeverityScalesTable Test Case
 */
class RiskSeverityScalesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RiskSeverityScalesTable
     */
    public $RiskSeverityScales;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RiskSeverityScales'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RiskSeverityScales') ? [] : ['className' => RiskSeverityScalesTable::class];
        $this->RiskSeverityScales = TableRegistry::getTableLocator()->get('RiskSeverityScales', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RiskSeverityScales);

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
