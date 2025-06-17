<h1>Plantas</h1>

<div style="display: flex; gap: 20px;">

    <!-- Lista de plantas -->
    <div style="flex: 3; display: flex; flex-wrap: wrap; gap: 20px;">
        <?php foreach ($plants as $plant): ?>
            <div style="width: 230px; border: 1px solid #ccc; border-radius: 8px; padding: 10px; box-shadow: 2px 2px 6px rgba(0,0,0,0.1); background: #fff;">
                <div class="plant-card">
                    <?php if (!empty($plant->image)): ?>
                        <?= $this->Html->image($plant->image, ['alt' => $plant->name, 'style' => 'max-width: 200px; height: auto; border-radius: 5px;']) ?>
                    <?php endif; ?>

                    <h3><?= h($plant->name) ?></h3>
                    <p><?= h($plant->description) ?></p>
                    <p><strong>Preço:</strong> R$ <?= number_format($plant->price, 2, ',', '.') ?></p>
                    <p><strong>Estoque:</strong> <?= $plant->stock ?></p>

                    <?= $this->Form->postLink(
                        'Adicionar ao carrinho',
                        ['controller' => 'CartItems', 'action' => 'add', $plant->id],
                        [
                            'style' => 'background: orange; border: none; padding: 10px; color: white; border-radius: 5px; cursor: pointer; display: block; text-align: center; margin-top: 10px;',
                            'confirm' => 'Deseja adicionar essa planta ao carrinho?'
                        ]
                    ) ?>
                </div>        
            </div>
        <?php endforeach; ?>
    </div>

<!-- Carrinho de Compras -->
<div style="flex: 1; min-width: 300px; padding: 20px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 2px 2px 8px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px; font-size: 1.5em;">Carrinho de Compras</h2>

    <?php if (!empty($cartItems)) : ?>
        <table style="width: 100%; font-size: 13px; border-collapse: collapse;">
            <thead>
                <tr style="background: #eee; text-align: left;">
                    <th style="padding: 8px;">Planta</th>
                    <th style="padding: 8px; text-align: right;">Preço</th>
                    <th style="padding: 8px; text-align: center;">Qtd</th>
                    <th style="padding: 8px; text-align: right;">Subtotal</th>
                    <th style="padding: 8px; text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($cartItems as $item): 
                    $subtotal = $item->quantity * $item->plant->price;
                    $total += $subtotal;
                ?>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 8px;"><?= h($item->plant->name) ?></td>
                        <td style="padding: 8px; text-align: right;">R$ <?= number_format($item->plant->price, 2, ',', '.') ?></td>
                        <td style="padding: 8px; text-align: center;"><?= $item->quantity ?></td>
                        <td style="padding: 8px; text-align: right;">R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                        <td style="padding: 8px; text-align: center;">
                            <?= $this->Html->link('+', ['controller' => 'CartItems', 'action' => 'increase', $item->id], ['style' => 'margin: 0 2px; padding: 2px 6px; font-size: 12px; background: #28a745; color: #fff; border-radius: 3px; text-decoration: none;']) ?>
                            <?= $this->Html->link('-', ['controller' => 'CartItems', 'action' => 'decrease', $item->id], ['style' => 'margin: 0 2px; padding: 2px 6px; font-size: 12px; background: #ffc107; color: #fff; border-radius: 3px; text-decoration: none;']) ?>
                            <?= $this->Form->postLink('🗑️', ['controller' => 'CartItems', 'action' => 'delete', $item->id], ['confirm' => 'Tem certeza?', 'style' => 'margin: 0 2px; padding: 2px 6px; font-size: 12px; background: #dc3545; color: #fff; border-radius: 3px; text-decoration: none;']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="padding: 8px; text-align: right;">Total:</th>
                    <th colspan="2" style="padding: 8px; text-align: right;">R$ <?= number_format($total, 2, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>

        <?= $this->Form->create(null, ['url' => ['controller' => 'CartItems', 'action' => 'checkout'], 'type' => 'post']) ?>
            <?= $this->Form->button('🛍️ Finalizar Compra', [
                'style' => 'margin-top: 15px; width: 100%; background: #dc3545; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; font-weight: bold; display: flex; justify-content: center; align-items: center;'
            ]) ?>
        <?= $this->Form->end() ?>
    <?php else : ?>
        <p style="padding: 10px; background: #fff3cd; border-radius: 5px; color: #856404;">Seu carrinho está vazio.</p>
    <?php endif; ?>
</div>


