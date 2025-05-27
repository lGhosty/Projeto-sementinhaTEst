<<h1>Plantas</h1>

<div style="display: flex;">
    <!-- Lista de plantas -->
    <div style="flex: 3; display: flex; flex-wrap: wrap; gap: 20px;">
        <?php foreach ($plants as $plant): ?>
            <div style="width: 230px; border: 1px solid #ccc; border-radius: 8px; padding: 10px; box-shadow: 2px 2px 6px rgba(0,0,0,0.1);">
                <div class="plant-card">
                    <?php if (!empty($plant->image)): ?>
                        <?= $this->Html->image($plant->image, ['alt' => $plant->name, 'style' => 'max-width: 200px; height: auto;']) ?>
                    <?php endif; ?>

                    <h3><?= h($plant->nome) ?></h3>
                    <p><?= h($plant->description) ?></p>
                    <p><strong>Preço:</strong> R$ <?= number_format($plant->price, 2, ',', '.') ?></p>
                    <p><strong>Estoque:</strong> <?= $plant->stock ?></p>

                    <?= $this->Form->postLink(
                        'Adicionar ao carrinho',
                        ['controller' => 'CartItems', 'action' => 'add', $plant->id],
                        [
                            'style' => 'background: orange; border: 3px solid #ccc; padding: 10px; color: white; border-radius: 5px; cursor: pointer; display: flex; justify-content: center; align-items: center; text-align: center;',
                            'confirm' => 'Deseja adicionar essa planta ao carrinho?'
                        ]
                    ) ?>
                </div>        
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Carrinho de Compras Detalhado -->
    <div style="flex: 1; padding: 20px; background-color: #f9f9f9; border-left: 1px solid #ccc;">
        <h2>Carrinho de Compras</h2>

        <?php if (!empty($cartItems)) : ?>
            <table class="table" style="width: 100%; font-size: 14px;">
                <thead>
                    <tr>
                        <th>Planta</th>
                        <th>Preço</th>
                        <th>Qtd</th>
                        <th>Subtotal</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($cartItems as $item): 
                        $subtotal = $item->quantity * $item->plant->price;
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td><?= h($item->plant->name) ?></td>
                            <td>R$ <?= number_format($item->plant->price, 2, ',', '.') ?></td>
                            <td><?= $item->quantity ?></td>
                            <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                            <td style="white-space: nowrap;">
                                <?= $this->Html->link('+', ['controller' => 'CartItems', 'action' => 'increase', $item->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link('-', ['controller' => 'CartItems', 'action' => 'decrease', $item->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                <?= $this->Form->postLink('🗑️', ['controller' => 'CartItems', 'action' => 'delete', $item->id], ['confirm' => 'Tem certeza?', 'class' => 'btn btn-danger btn-sm']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total:</th>
                        <th colspan="2">R$ <?= number_format($total, 2, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>

            <?= $this->Form->create(null, ['url' => ['controller' => 'CartItems', 'action' => 'checkout'], 'type' => 'post']) ?>
                <?= $this->Form->button('🛍️ Finalizar Compra', ['class' => 'btn btn-primary', 'style' => 'margin-top: 10px;']) ?>
            <?= $this->Form->end() ?>
        <?php else : ?>
            <p>Seu carrinho está vazio.</p>
        <?php endif; ?>
    </div>
</div>
