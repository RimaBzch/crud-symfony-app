<?php // src/Controller/InscriptionController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Article\ArticlesYamlProvider;

Class InscriptionController extends AbstractController
{
/**
* @Route("/Accueil", name="Accueil")
*/
public function number()
{

$number = random_int(0, 100);

return $this->render('Inscription/accueil.html.twig', [
    'number' => $number,
    ]);
}
/**
*@Route("/essai", name="default")
*/

public function index()
{
$articleYamlProvider=new ArticlesYamlProvider();
dump($articleYamlProvider->getArticles());
return $this->render('Inscription/index.html.twig', [
'controller_name' => 'InscriptionController',
]);
}
}
?>