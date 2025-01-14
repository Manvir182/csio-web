<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaturityAttribureOptionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaturityAttribureOptionsTable Test Case
 */
class MaturityAttribureOptionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MaturityAttribureOptionsTable
     */
    public $MaturityAttribureOptions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MaturityAttribureOptions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MaturityAttribureOptions') ? [] : ['className' => MaturityAttribureOptionsTable::class];
        $this->MaturityAttribureOptions = TableRegistry::getTableLocator()->get('MaturityAttribureOptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MaturityAttribureOptions);

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
