<h1>Plantas</h1>

<div style="display: flex; flex-wrap: wrap; gap: 20px;">
    <?php foreach ($plants as $plant): ?>
        
        <div style="width: 200px; border: 1px solid #ccc; border-radius: 8px; padding: 10px; box-shadow: 2px 2px 6px rgba(0,0,0,0.1);">
            
            <?= $this->Html->image(
                'plants/' . rawurlencode($plant->image), // usa encode para espaços e acentos
                [
                    'alt' => h($plant->nome),
                    'style' => 'width: 100%; border-radius: 8px;'
                ]
            ) ?>

            <h3><?= h($plant->nome) ?></h3>
            <p><?= h($plant->description) ?></p>
            <p><strong>$ <?= number_format($plant->price, 2) ?></strong></p>
            <button style="background: orange; border: none; padding: 10px; color: white; border-radius: 5px; cursor: pointer;">Adicionar ao carrinho</button>
        </div>
    <?php endforeach; ?>
</div>
