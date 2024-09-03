<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RisksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RisksTable Test Case
 */
class RisksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RisksTable
     */
    public $Risks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Risks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Risks') ? [] : ['className' => RisksTable::class];
        $this->Risks = TableRegistry::getTableLocator()->get('Risks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Risks);

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
