<h1>Plantas</h1>

<div style="display: flex; flex-wrap: wrap; gap: 20px;">
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

<h2>Seu Carrinho de Compras</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Planta</th>
        <th>Quantidade</th>
        <th>Ações</th>
    </tr>

    <?php if (!empty($cartItems)): ?>
        <?php foreach ($cartItems as $item): ?>
            <tr>
                <td><?= h($item->plant->name) ?></td>
                <td><?= h($item->quantity) ?></td>
                <td>
                    <?= $this->Form->postLink(
                        'Remover',
                        ['controller' => 'CartItems', 'action' => 'delete', $item->id],
                        ['confirm' => 'Tem certeza?']
                    ) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="3">Seu carrinho está vazio.</td></tr>
    <?php endif; ?>
</table>

<?php if (!empty($cartItems)): ?>
    <?= $this->Form->postLink(
        'Confirmar Compra',
        ['controller' => 'CartItems', 'action' => 'checkout'],
        ['confirm' => 'Deseja finalizar a compra?', 'style' => 'margin-top: 20px; display: inline-block; padding: 10px 20px; background-color: green; color: white; border-radius: 5px; text-decoration: none;']
    ) ?>
<?php endif; ?>


