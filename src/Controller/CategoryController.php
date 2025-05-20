<?php

namespace App\Controller;

use App\Entity\Category;
use App\Service\CategoryService;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    public function __construct(
        private readonly CategoryService $categoryService
    )
    {}

    #[Route('/categories', name: 'app_category_all')]
    public function showAll(): Response
    {
        try {
            $categories = $this->categoryService->getAllCategories();
        }
        catch(\Exception $e) {
            $categories = null;
        }
        

        return $this->render('category/categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/category/add', name:'app_category_add')]
    public function addCategory(Request $request) {

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $message = "";
            $type = "";
            try {
                $this->categoryService->saveCategory($category);
                $message = "La categorie a été ajouté";
                $type = "success";
            } catch (\Exception $e) {
                $message = $e->getMessage();
                $type = "danger";
            }
            $this->addFlash($type, $message);
        }
        return $this->render('category/category_add.html.twig',[
            'formulaire' => $form
        ]);
    }
}
