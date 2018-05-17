<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Hateoas\Configuration\Annotation as Hateoas;
use AppBundle\Entity\Listreq;

class ListDemandeController extends Controller
{
    /**
     * create service
     *
     *
     * @Rest\Post("/demandes")
     *
     * @SWG\Response(response=200,description="Success",)
     *
     * @SWG\Tag(name="demandes")
     *
     * @param Request $request
     * @return array|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface|static
     * @Rest\View()
     */

    public function createAction(Request $request)
    {

        $aOptions = $request->request->all();
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository('AppBundle:Annonce')
            ->findOneBy(['id' => $aOptions['jour']]);

        $demande = new Listreq();
        $demande->setJour($aOptions['jour']);
        $demande->setFrom($aOptions['from']);
        $demande->setTo($aOptions['to']);
        $demande->setSubject($aOptions['subject']);
        $demande->setService($service);
        $demande->setValid(0);

        // persist data

        $em->persist($demande);
        $em->flush();

        return  new Response('request created successfully',  Response::HTTP_CREATED);



    }

    /**
     * Get all requests
     *
     * This call retrieves all services
     *
     * @Rest\Get("/demandes")
     *
     * @SWG\Response(response=200,description="Success",)
     * @SWG\Response(response=404,description="No Professional",)
     *
     * @SWG\Tag(name="demandes")
     *
     *
     * @return Response
     * @Rest\View(serializerGroups={"demande"})
     */
    public function listAction()
    {
        $demandes=$this->getDoctrine()->getRepository('AppBundle:Listreq')->findAll();
        if (!count($demandes)){
            $response=array(
                'code'=>1,
                'message'=>'No posts found!',
                'errors'=>null,
                'result'=>null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        $data=$this->get('jms_serializer')->serialize($demandes,'json');
        $response=array(
            'code'=>0,
            'message'=>'success',
            'errors'=>null,
            'result'=>json_decode($data)
        );
        return new JsonResponse($response,200);
    }

    /**
     * delete one services
     *
     * This call deletes selected services
     *
     * @Rest\Delete("/demnades/{id}")
     *
     * @SWG\Response(response=200,description="Success",)
     *
     * @SWG\Tag(name="demande")
     *
     *
     * @return array|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface|static
     * @Rest\View(serializerGroups={"demnade"})
     */

    public function deleteAction($id)
    {
        $demandes = $this->getDoctrine()->getRepository('AppBundle:Listreq')->find($id);
        if (empty($demandes)) {
            $response = array(
                'code' => 1,
                'message' => 'request Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($demandes);
        $em->flush();
        $response = array(
            'code' => 0,
            'message' => 'request deleted !',
            'errors' => null,
            'result' => null
        );
        return new JsonResponse($response, 200);
    }

    /**
     * request Validation
     * @Rest\POST("/valid-req")
     *
     * @SWG\Response(response=200,description="Success",)
     * @SWG\Response(response=400,description="Missing  parameter",)
     * @SWG\Response(response=401,description=" parameter should not be blank",)
     * @SWG\Response(response=402,description="Wrong code",)
     *

     * @SWG\Tag(name="req")
     *
     * @param Request $request
     * @return array|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface|static
     * @Rest\View()
     */

    public function ValidReqAction(Request $request)
    {

        $id=$request->request->get('id');

        $em = $this->get('doctrine.orm.entity_manager');

        $oUser = $em->getRepository('AppBundle:Listreq')
            ->findOneBy([
                'id' => $id,
            ]);

        $oUser->setValid(1);

        $em->persist($oUser);
        $em->flush();

        return  new Response('set valid to one',  Response::HTTP_CREATED);


    }
}
