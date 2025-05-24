<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlantsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlantsTable Test Case
 */
class PlantsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlantsTable
     */
    protected $Plants;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Plants',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Plants') ? [] : ['className' => PlantsTable::class];
        $this->Plants = $this->getTableLocator()->get('Plants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Plants);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PlantsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
