<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CartItemsFixture
 */
class CartItemsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'plant_id' => 1,
                'quantity' => 1,
                'created' => '2025-05-26 17:51:09',
                'modified' => '2025-05-26 17:51:09',
            ],
        ];
        parent::init();
    }
}
