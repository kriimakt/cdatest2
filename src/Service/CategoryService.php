<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class CategoryService
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly EntityManagerInterface $em
    )
    {}

    public function getAllCategories() :array{
        try {
            //Récupération des categories
            $categories = $this->categoryRepository->findAll();
            //Tester si la liste est vide
            if($this->categoryRepository->count() == 0) {
                //lever une exception personnalisée
                throw new \Exception("La liste des catégories est vide");
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        //Retourne la liste des catègories
        return $categories;
    }

    public function saveCategory(Category $category){
        try {
            //Test si elle n'existe pas déja
            if($this->categoryRepository->findOneBy(["label"=>$category->getLabel()])) {
                throw new \Exception("La categorie existe déja");
            }
            //Ajouter en BDD
            $this->em->persist($category);
            $this->em->flush();
            } 
        catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        
        return true;
    }
}