<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Création de catégories pour le pressing avec des prix
        $categoriesData = [
            ['name' => 'Nettoyage à sec', 'description' => 'Nettoyage des vêtements à sec', 'price' => 5],
            ['name' => 'Repassage', 'description' => 'Repassage des vêtements', 'price' => 3],
            ['name' => 'Lavage', 'description' => 'Lavage des vêtements', 'price' => 8],
            ['name' => 'Teinturerie', 'description' => 'Teinturerie pour les vêtements', 'price' => 10],
            ['name' => 'Ourlet', 'description' => 'Ourlet pour les vêtements', 'price' => 5],
            ['name' => 'Raccommodage', 'description' => 'Raccommodage des vêtements', 'price' => 5],
        ];

        $categories = [];

        foreach ($categoriesData as $categoryData) {
            $category = new Category();
            $category->setName($categoryData['name']);
            $category->setDescription($categoryData['description']);
            $category->setPrice($categoryData['price']);
            $manager->persist($category);
            $categories[] = $category;
        }

        // Création d'articles pour le pressing
        $articlesData = [
            ['name' => 'Chemise en coton', 'description' => 'Chemise en coton à nettoyer', 'price' => 5, 'categories' => [0, 1]],
            ['name' => 'Chemise en soie', 'description' => 'Chemise en soie à nettoyer', 'price' => 8, 'categories' => [0, 1]],
            ['name' => 'Pantalon', 'description' => 'Pantalon à repasser', 'price' => 3, 'categories' => [1, 5]],
            ['name' => 'Robe', 'description' => 'Robe à laver en machine', 'price' => 8, 'categories' => [2, 3]],
            ['name' => 'Costume', 'description' => 'Costume complet à nettoyer', 'price' => 12, 'categories' => [0, 1, 2, 4]],
            ['name' => 'Jupe', 'description' => 'Jupe à repasser', 'price' => 5, 'categories' => [5]],
            ['name' => 'Manteau', 'description' => 'Manteau à nettoyer', 'price' => 15, 'categories' => [0, 3]],
            ['name' => 'Pull en laine', 'description' => 'Pull en laine à laver à la main', 'price' => 7, 'categories' => [2, 5]],
            ['name' => 'Veste en cuir', 'description' => 'Veste en cuir à nettoyer', 'price' => 20, 'categories' => [0]],
            ['name' => 'Sac à main', 'description' => 'Sac à main à nettoyer', 'price' => 8, 'categories' => [0, 3]],
        ];

        foreach ($articlesData as $articleData) {
            $article = new Article();
            $article->setName($articleData['name']);
            $article->setDescription($articleData['description']);
            $article->setPrice($articleData['price']);
            foreach ($articleData['categories'] as $categoryId) {
                $article->addCategory($categories[$categoryId]);
            }
            $manager->persist($article);
        }

        $manager->flush();
    }
}