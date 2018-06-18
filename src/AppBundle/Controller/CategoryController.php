<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations as Rest;
use Hateoas\Configuration\Annotation as Hateoas;
use Swagger\Annotations as SWG;


class CategoryController extends Controller
{
    /**
     * Get all categories
     *
     * This call retrieves all categories
     *
     * @Rest\Get("/user/category")
     *
     * @SWG\Response(response=200,description="Success",)
     *
     * @SWG\Tag(name="annonce")
     *
     *
     * @return array|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface|static
     * @Rest\View(serializerGroups={"category"})
     */

    public function listAction()
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        $data = $this->get('jms_serializer')->serialize($categories, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
