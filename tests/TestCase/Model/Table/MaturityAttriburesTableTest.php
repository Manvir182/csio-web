<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaturityAttriburesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaturityAttriburesTable Test Case
 */
class MaturityAttriburesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MaturityAttriburesTable
     */
    public $MaturityAttribures;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MaturityAttribures'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MaturityAttribures') ? [] : ['className' => MaturityAttriburesTable::class];
        $this->MaturityAttribures = TableRegistry::getTableLocator()->get('MaturityAttribures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MaturityAttribures);

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
