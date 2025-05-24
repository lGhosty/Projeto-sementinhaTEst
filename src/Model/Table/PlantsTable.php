<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plants Model
 *
 * @method \App\Model\Entity\Plant newEmptyEntity()
 * @method \App\Model\Entity\Plant newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Plant> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Plant get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Plant findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Plant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Plant> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Plant|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Plant saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Plant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Plant>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Plant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Plant> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Plant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Plant>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Plant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Plant> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlantsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('plants');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('nome')
            ->maxLength('nome', 255)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->integer('stock')
            ->allowEmptyString('stock');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->allowEmptyFile('image');

        return $validator;
    }
}
