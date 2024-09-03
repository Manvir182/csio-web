<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GenControlRequirementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GenControlRequirementsTable Test Case
 */
class GenControlRequirementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GenControlRequirementsTable
     */
    public $GenControlRequirements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.GenControlRequirements',
        'app.GenControls'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GenControlRequirements') ? [] : ['className' => GenControlRequirementsTable::class];
        $this->GenControlRequirements = TableRegistry::getTableLocator()->get('GenControlRequirements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GenControlRequirements);

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
