<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PokemonRepository;
use App\Repository\CombatRepository;
use App\Entity\Combat;
use App\Form\CombatType;
use Doctrine\ORM\EntityManagerInterface;

final class CombatController extends AbstractController
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository, 
        private readonly CombatRepository $combatRepository,
        private readonly EntityManagerInterface $entityManager
        ) {}

    #[Route('/combat', name: 'app_combat')]
    public function index(): Response
    {
        return $this->render('combat/index.html.twig', [
            'pokemons'=>$this->pokemonRepository->findAll(),
        ]);
    }

    #[Route('/combat/lancerCombat', name: 'app_lancerCombat')]
    public function lancerCombat(Request $request): Response
    {
        $combat = new Combat();
        $form = $this->createForm(CombatType::class, $combat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sélectionner un Pokémon au hasard
            $allPokemons = $this->pokemonRepository->findAll();
            $randomPokemon = $allPokemons[array_rand($allPokemons)];
            $combat->setPokemon2($randomPokemon);
            $combat->setNbrTour(0);
            $this->entityManager->persist($combat); 
            $this->entityManager->flush();

            return $this->redirectToRoute('app_letSFight');
        }
        return $this->render('combat/lancerCombat.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/combat/letSFight', name:'app_letSFight')]
    public function letSFight(): Response{
        $lastCombat = $this->combatRepository->findOneBy([],['id' => 'DESC']);

        if($lastCombat){
            $pokemon1 = clone $lastCombat->getPokemon1();
            $pokemon2 = clone $lastCombat->getPokemon2();

            while ($pokemon1->getPointDeVie() > 0 && $pokemon2->getPointDeVie() > 0) { 
                $damage = $pokemon1->getPointAttaque() * (1 - ($pokemon2->getPointDefense() / 100)); 
                $pokemon2->setPointDeVie($pokemon2->getPointDeVie() - $damage);

                if ($pokemon2->getPointDeVie() <= 0) { 
                    $winner = $pokemon1; 
                }

                $damage = $pokemon2->getPointAttaque() * (1 - ($pokemon1->getPointDefense() / 100)); 
                $pokemon1->setPointDeVie($pokemon1->getPointDeVie() - $damage);

                if ($pokemon1->getPointDeVie() <= 0) { 
                    $winner = $pokemon2; 
                }
                $lastCombat->setNbrTour($lastCombat->getNbrTour() + 1); 
            }
            $this->entityManager->flush();
            return $this->render('combat/letSFight.html.twig', [ 
                'lastCombat' => $lastCombat, 
                'winner' => $winner, 
            ]);
        }

        return $this->render('combat/letSFight.html.twig', [
            'lastCombat' => null,
            'winner' => null,
        ]);
    }
}
