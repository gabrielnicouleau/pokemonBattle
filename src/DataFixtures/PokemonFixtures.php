<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\Pokemon;

class PokemonFixtures extends Fixture
{
    public function __construct(private readonly HttpClientInterface $client){}

    public function load(ObjectManager $manager): void  {
        $response = $this->client->request("GET","https://pokebuildapi.fr/api/v1/pokemon");
        $pokemons = $response->toArray();
        foreach ($pokemons as $pokemonData) {
            $pokemon = new Pokemon();
            $pokemon->setNom($pokemonData['name']);
            $pokemon->setPointDeVie($pokemonData['stats']['HP']);
            $pokemon->setPointAttaque($pokemonData['stats']['attack']);
            $pokemon->setPointDefense($pokemonData['stats']['defense']);
            $pokemon->setImage($pokemonData['image']);

            $manager->persist($pokemon);
        }

        $manager->flush();
    }
}