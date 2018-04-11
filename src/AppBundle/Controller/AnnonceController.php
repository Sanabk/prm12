<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\RouteRedirectView;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Hateoas\Configuration\Annotation as Hateoas;


/**
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_annonce_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "app_annonce_update",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 *
 */
class AnnonceController extends Controller
{

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="show a single pub by id"
     * )
     * @Get(
     *     path = "/api/annonces/{id}",
     *     name = "app_annonce_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     *
     *
     */
    public function showAction(Annonce $annonce)
    {
        $data = $this->get('jms_serializer')->serialize($annonce, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="show a single pub by category"
     * )
     * @Get(
     *     path = "/api/annonces/{category}",
     *     name = "app_annonce_show",
     *
     * )
     * @View
     *
     *
     */
    public function show1Action(Annonce $annonce)
    {
        $data = $this->get('jms_serializer')->serialize($annonce, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @ApiDoc(
     *     description="create new pub"
     * )
     * @Route("/api/annonces", name="annonce_create")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();
        $annonce = $this->get('jms_serializer')->deserialize($data, 'AppBundle\Entity\Annonce', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($annonce);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    /**
     *
     * @ApiDoc(
     *     resource=true,
     *     description="show all pubs"
     * )
     * @Route("/api/annonces", name="annone_list")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $annonces = $this->getDoctrine()->getRepository('AppBundle:Annonce')->findAll();
        $data = $this->get('jms_serializer')->serialize($annonces, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @ApiDoc(
     *     description="Delete pub by id"
     * )
     * @Route("/api/annonces/{id}",name="delete_annonce")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        $annonce = $this->getDoctrine()->getRepository('AppBundle:Annonce')->find($id);
        if (empty($annonce)) {
            $response = array(
                'code' => 1,
                'message' => 'anonnce Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($annonce);
        $em->flush();
        $response = array(
            'code' => 0,
            'message' => 'annonce deleted !',
            'errors' => null,
            'result' => null
        );
        return new JsonResponse($response, 200);
    }

    /**
     *
     * @ApiDoc(
     *     description="Update annonce"
     * )
     * @param Request $request
     * @param $id
     * @Route("/api/annonces/{id}",name="update_annonce")
     * @Method({"POST"})
     * @return JsonResponse
     */
    public function updatePublication(Request $request, $id)
    {
        $annonce = $this->getDoctrine()->getRepository('AppBundle:Annonce')->find($id);

        $data = [
            'title' => $request->request->get('title'),
            'description' => $request->request->get('description'),
            'category' => $request->request->get('category'),
            'city' => $request->request->get('city'),
            'phone' => $request->request->get('phone'),
            'picture' => $request->request->get('picture'),
        ];

        var_dump($data);

        $annonce->setTitle($data['title']);
        $annonce->setDescription($data['description']);
        $annonce->setCategory($data['category']);
        $annonce->setCity($data['city']);
        $annonce->setPhone($data['phone']);
        $annonce->setPicture($data['picture']);


        $em = $this->getDoctrine()->getManager();
        $em->merge($annonce);
        $em->flush();

        $response = array(
            'code' => 0,
            'message' => 'annonce updated!',
            'errors' => null,
            'result' => null
        );
        return new JsonResponse($response, 200);
    }
}