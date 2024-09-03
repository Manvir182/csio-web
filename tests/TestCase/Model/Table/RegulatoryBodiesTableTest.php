<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RegulatoryBodiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RegulatoryBodiesTable Test Case
 */
class RegulatoryBodiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RegulatoryBodiesTable
     */
    public $RegulatoryBodies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RegulatoryBodies',
        'app.GenControls',
        'app.RbControls',
        'app.Assessments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RegulatoryBodies') ? [] : ['className' => RegulatoryBodiesTable::class];
        $this->RegulatoryBodies = TableRegistry::getTableLocator()->get('RegulatoryBodies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RegulatoryBodies);

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
