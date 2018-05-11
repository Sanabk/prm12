<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Hateoas\Configuration\Annotation as Hateoas;

class ReclamationsController extends Controller
{
    /**
     * create new reclamation
     *
     *
     * @Rest\Post("/reclamations")
     *
     * @SWG\Response(response=200,description="Success",)
     *
     * @SWG\Tag(name="reclamation")
     *
     * @param Request $request
     * @return array|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface|static
     * @Rest\View()
     */

    public function AddreclamationAction(Request $request)
    {
        $data = $request->getContent();
        $reclamation = $this->get('jms_serializer')->deserialize($data, 'AppBundle\Entity\Reclamation', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($reclamation);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $reclamation->setUser($user);
        $em->flush();

        return new Response('success', Response::HTTP_CREATED);
    }

    /**
     * Get all reclamations
     *
     * This call retrieves all reclamations
     *
     * @Rest\Get("/reclamations")
     *
     * @SWG\Response(response=200,description="Success",)
     *
     * @SWG\Tag(name="annonce")
     *
     *
     * @return array|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface|static
     * @Rest\View(serializerGroups={"reclamations"})
     */

    public function listreclAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $reclamations = $user->getReclamations();
        $data = $this->get('jms_serializer')->serialize($reclamations, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
