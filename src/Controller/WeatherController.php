<?php

namespace App\Controller;

use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\WeatherType;

final class WeatherController extends AbstractController
{
    public function __construct(
        private readonly WeatherService $weatherService
    ) {}


    #[Route('/weather', name: 'app_weather')]
    public function displayWeatherByCity(Request $request): Response
    {
        $form = $this->createForm(WeatherType::class);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $city = $request->request->all('weather')['city'];
            $weather = $this->weatherService->getWeatherByCity($city);
        }

        return $this->render('weather/index.html.twig', [
            'form' => $form,
            'weather'=> $weather ?? null
        ]);
    }
}
