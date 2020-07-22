<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findAll()
    {
        return $this->createQueryBuilder('p'); //crée une requête qui va récupérer tous les posts, sans filtre spécifique
    }


    /**
    * @return Post[] Returns an array of Post objects associated with given tag
    */
    
    public function findByTag(Tag $tag)
    {
        return $this->createQueryBuilder('post') //fait une requete sur un post
            ->innerJoin('post.tags','tag') //dont la colonne tags du post correspond à tel tag
            ->andWhere('tag.id = :id') //tag, dont l'id doit être égal à l'id du tag passé en paramètre
            ->setParameter('id', $tag->getId()) //prend le param $id et l'injecte dans le :id au dessus (sécurité)
            ->orderBy('post.title', 'DESC') // ordonner par ordre croissant suivant le titre du post
            ->setMaxResults(10)
        ;
    }
    
        
    public function findByTagDQL(Tag $tag)
    {
        $entityManager = $this->getEntityManager();        
        
        return $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Post p
            INNER JOIN p.tags t
            WHERE t.id = :id
            ORDER BY p.title ASC'
        )->setParameter('id', $tag->getId());       
    }
    
    public function findByCategory(Category $category)
    {
        return $this->createQueryBuilder('post') //fait une requete sur un post
            ->innerJoin('post.category','category') //dont la colonne category du post correspond à telle category
            ->andWhere('category.id = :id') //tag, dont l'id doit être égal à l'id de la category passée en paramètre
            ->setParameter('id', $category->getId()) //prend le param $id et l'injecte dans le :id au dessus (sécurité)
            ->orderBy('post.title', 'DESC') // ordonner par ordre croissant suivant le titre du post
            ->setMaxResults(10)
            // ->getQuery() //getQuery() génére le sql du queryBuilder et envoie la requête au serveur - on a un pointeur 
            // ->getResult() // le serveur de données a exé la requête et php récupére un tableau avec les données
        ;
    }

    public function findByCategoryEmpty()
    {
        return $this->createQueryBuilder('post') //fait une requete sur un post
            ->Where('post.category is NULL') //tag, dont l'id doit être égal à l'id de la category passée en paramètre
            ->orderBy('post.title', 'ASC') // ordonner par ordre croissant suivant le titre du post
            ->setMaxResults(10)
            // ->getQuery()
            // ->getResult()
    ;
    }

    public function findByCategoryEmptyDQL()
    {
        $entityManager = $this->getEntityManager();        
        
        return $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Post p
            WHERE p.category is NULL
            ORDER BY p.title ASC'
        );
      
    
    }
    
    /*
    public function findOneBySomeField($value): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
