<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Annonce;
use AppBundle\Entity\Category;
use AppBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Swagger\Annotations as SWG;
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
     * Get all annonces
     *
     * This call retrieves all services
     *
     * @Rest\Get("/user/annonces/all")
     *
     * @SWG\Response(response=200,description="Success",)
     * @SWG\Response(response=404,description="No Professional",)
     *
     * @SWG\Tag(name="annonces")
     *
     *
     * @return Response
     * @Rest\View(serializerGroups={"service"})
     */
    public function listAction()
    {
//        $demandes=$this->getDoctrine()->getRepository('AppBundle:Annonce')->findAll();
//        if (!count($demandes)){
//            $response=array(
//                'code'=>1,
//                'message'=>'No requests found!',
//                'errors'=>null,
//                'result'=>null
//            );
//            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
//        }
//        $data=$this->get('jms_serializer')->serialize($demandes,'json');
//        $response=array(
//            'code'=>0,
//            'message'=>'success',
//            'errors'=>null,
//            'result'=>json_decode($data)
//        );
//        return new JsonResponse($response,200);
         $annonces=$this->getDoctrine()->getRepository('AppBundle:Annonce')->findAll();

        $data = $this->get('jms_serializer')->serialize($annonces, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    /**
     * Get one service
     *
     * This call retrieves all services
     *
     * @Rest\Get("/user/annonces/{id}")
     *
     * @SWG\Response(response=200,description="Success",)
     * @SWG\Response(response=404,description="No Professional",)
     *
     * @SWG\Tag(name="annonce")
     *
     *
     * @return array|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface|static
     * @Rest\View(serializerGroups={"service"})
     */
    public function showAction(Annonce $annonce)
    {

        $data = $this->get('jms_serializer')->serialize($annonce, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /**
     * create service
     *
     *
     * @Rest\Post("/user/annonces")
     *
     * @SWG\Response(response=200,description="Success",)
     *
     * @SWG\Tag(name="service")
     *
     * @param Request $request
     * @return array|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface|static
     * @Rest\View()
     */

    public function createAction(Request $request)
    {
        $aOptions = $request->request->all();


        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('AppBundle:Category')
            ->findOneBy(['name' => $aOptions['category']]);
        $annonce = new Annonce();
        $annonce->setTitle($aOptions['title']);
        $annonce->setDescription($aOptions['description']);
        $annonce->setCity($aOptions['city']);
        $annonce->setPicture($aOptions['picture']);
        $annonce->setPhone($aOptions['phone']);
        $annonce->setCategory($categorie);
        $annonce->setCateg($aOptions['category']);


        $user = $this->get('security.token_storage')->getToken()->getUser();
        $annonce->setUser($user);
        // persist data
        $em->persist($annonce);
        $em->flush();

        return  new Response('service created successfully',  Response::HTTP_CREATED);


    }

    /**
     * Get all services
     *
     * This call retrieves all services
     *
     * @Rest\Get("/user/annonces")
     *
     * @SWG\Response(response=200,description="Success",)
     * @SWG\Response(response=404,description="No Professional",)
     *
     * @SWG\Tag(name="annonce")
     *
     *
     * @return array|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface|static
     * @Rest\View(serializerGroups={"service"})
     */
    public function lisstAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $annonces = $user->getAnnonces();
        $data = $this->get('jms_serializer')->serialize($annonces, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    /**
     * delete one services
     *
     * This call deletes selected services
     *
     * @Rest\Delete("/user/annonces/{id}")
     *
     * @SWG\Response(response=200,description="Success",)
     *
     * @SWG\Tag(name="annonce")
     *
     *
     * @return array|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface|static
     * @Rest\View(serializerGroups={"service"})
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
     * update service
     *
     *
     * @Rest\Post("/user/annonces/{id}")
     *
     * @SWG\Response(response=200,description="Success",)
     *
     * @SWG\Tag(name="service")
     *
     * @param Request $request
     * @return array|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface|static
     * @Rest\View()
     */

    public function updatePublication(Request $request, $id)
    {
        $annonce = $this->getDoctrine()->getRepository('AppBundle:Annonce')->find($id);

        $aOptions = $request->request->all();

        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('AppBundle:Category')
            ->findOneBy(['name' => $aOptions['category']]);
        $annonce->setTitle($aOptions['title']);
        $annonce->setDescription($aOptions['description']);
        $annonce->setCity($aOptions['city']);
        $annonce->setPicture($aOptions['picture']);
        $annonce->setPhone($aOptions['phone']);
        $annonce->setCategory($categorie);
        $annonce->setCateg($aOptions['category']);

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $annonce->setUser($user);
        // persist data
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