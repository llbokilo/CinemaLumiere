<?php

namespace App\Controller;

use App\Entity\Film;
use App\Service\GenreService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Genre;
use App\Entity\Seance;
use App\Form\FilmTypeFormType;
use App\Form\GenreTypeFormType;
use App\Form\SeanceTypeFormType;
use App\Service\FilmService;
use App\Service\SeanceService;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function index(): Response
    {
        return $this->render('administration/index.html.twig', [
            'controller_name' => 'AdministrationController',
        ]);
    }
    /**
     * @Route("administration/genres",name="liste_genres")
     */
    public function listeGenres(GenreService $genreService): Response
    {
        $genres = $genreService->liste();
        return $this->render('administration/genres/liste_genres.html.twig', [
            'genres' => $genres,
        ]);
    }
    /**
     * @Route("administration/films",name="liste_films")
     */
    public function listeFilms(FilmService $filmService): Response
    {
        $films = $filmService->liste();
        return $this->render('administration/films/liste_films.html.twig', [
            'films' => $films,
        ]);
    }
    /**
     * @Route("administration/seances",name="liste_seances")
     */
    public function listeSeances(SeanceService $seanceService): Response
    {
        $seances = $seanceService->liste();
        return $this->render('administration/seances/liste_seances.html.twig', [
            'seances' => $seances,
        ]);
    }
    /**
     * @Route("administration/genres/add",name="admin_creer_genre")
     */
    public function creerGenres(GenreService $pGenreService): Response
    {
        $genre = new Genre();

        $formulaire = $this->createForm(GenreTypeFormType::class, $genre);

        $request = Request::createFromGlobals();

        $formulaire->handleRequest($request);
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $pGenreService->ajouter($formulaire->getData());
            return $this->redirectToRoute('task_success');
        } else
            return $this->render('administration/genres/form_genres.html.twig', [
                'formulaire' => $formulaire->createView()
            ]);
    }
    /**
     * @Route("administration/films/add", name="admin_creer_film")
     */
    public function creerFilms(FilmService $pFilmService)
    {
        $film = new Film();
        $formulaire = $this->createForm(FilmTypeFormType::class, $film);
        
        $request = Request::createFromGlobals();

        $formulaire->handleRequest($request);
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $pFilmService->ajouter($formulaire->getData());
            return $this->redirectToRoute('task_success');
        } else
            return $this->render('administration/films/form_films.html.twig', [
                'formulaire' => $formulaire->createView()
            ]);
    }
    /**
     * @Route("administration/seances/add", name="admin_creer_seance")
     */
    public function creerSeances(SeanceService $pSeanceService)
    {
        $seance = new Seance();
        $formulaire = $this->createForm(SeanceTypeFormType::class, $seance);

        $request = Request::createFromGlobals();

        $formulaire->handleRequest($request);
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $pSeanceService->ajouter($formulaire->getData());
            return $this->redirectToRoute('task_success');
        } else
            return $this->render('administration/seances/form_seances.html.twig', [
                'formulaire' => $formulaire->createView()
            ]);
    }
    /**
     * @Route("/administration/success", name="task_success")
     */
    public function success(): Response
    {
        return $this->render('administration/success.html.twig', [
            'controller_name' => 'AdministrationController'
        ]);
    }
}
