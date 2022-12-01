<?php

namespace App\Helpers;

use App\Entity\Post;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostImport
{
    public function __invoke(ManagerRegistry $doctrine)
    {

        $posts = simplexml_load_file('https://www.ctvnews.ca/rss/world/ctvnews-ca-world-public-rss-1.822289');
        
        if($posts){
            foreach ($posts->channel->item as $post) {
                $postModel = new Post;

                $postModel->setTitle($post->title);
                $postModel->setImage($post->enclosure['@attributes']->url);
                $postModel->setDescription($post->description ?? 'null');

                $this->doctrine->flush();
            }
        }
    }
}