<?php

namespace App\Factory;

use App\Entity\Restaurante;
use App\Repository\RestauranteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Restaurante>
 *
 * @method        Restaurante|Proxy                     create(array|callable $attributes = [])
 * @method static Restaurante|Proxy                     createOne(array $attributes = [])
 * @method static Restaurante|Proxy                     find(object|array|mixed $criteria)
 * @method static Restaurante|Proxy                     findOrCreate(array $attributes)
 * @method static Restaurante|Proxy                     first(string $sortedField = 'id')
 * @method static Restaurante|Proxy                     last(string $sortedField = 'id')
 * @method static Restaurante|Proxy                     random(array $attributes = [])
 * @method static Restaurante|Proxy                     randomOrCreate(array $attributes = [])
 * @method static RestauranteRepository|RepositoryProxy repository()
 * @method static Restaurante[]|Proxy[]                 all()
 * @method static Restaurante[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Restaurante[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Restaurante[]|Proxy[]                 findBy(array $attributes)
 * @method static Restaurante[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Restaurante[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class RestauranteFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'body' => self::faker()->text(100),
            'nombre' => self::faker()->text(80),
            'ranking' => self::faker()->randomNumber(),
            'website' => self::faker()->text(100),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Restaurante $restaurante): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Restaurante::class;
    }
}
