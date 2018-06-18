<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Disponibilities;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Hateoas\Configuration\Annotation as Hateoas;


class DisponibilitiesController extends Controller
{
    /**
     * create Dispo
     *
     *
     * @Rest\Post("/user/create/dispo")
     *
     * @SWG\Response(response=200,description="Success",)
     *
     * @SWG\Tag(name="disponibility")
     *
     * @param Request $request
     * @return array|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface|static
     * @Rest\View()
     */

    public function createAction(Request $request)
    {
        $aOptions = $request->request->all();


        $em = $this->getDoctrine()->getManager();
        $prf = $em->getRepository('AppBundle:Client')
             ->findOneBy(['id' => $aOptions['Day']]);

        $dispo = new Disponibilities();
        $dispo->setDay($aOptions['Day']);
        $dispo->setFromo($aOptions['Fromo']);
        $dispo->setToo($aOptions['Too']);
        $dispo->setFromt($aOptions['Fromt']);
        $dispo->setTot($aOptions['Tot']);
        $dispo->setProf($prf);


        $user = $this->get('security.token_storage')->getToken()->getUser();
        $dispo->setProf($user);
        // persist data
        $em->persist($dispo);
        $em->flush();

        return  new Response('Dispo created successfully',  Response::HTTP_CREATED);


    }

    /**
     * Get all disponibilities
     *
     * This call retrieves all services
     *
     * @Rest\Get("/user/list/dispo/{id}")
     *
     * @SWG\Response(response=200,description="Success",)
     * @SWG\Response(response=404,description="No Professional",)
     *
     * @SWG\Tag(name="dispo")
     * @return Response
     * @Rest\View(serializerGroups={"dispo"})
     */
    public function listAction($id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:Client')->find($id);

        $dispon=$this->getDoctrine()->getRepository('AppBundle:Disponibilities')->findBy(array('prof'=> $user));
        if (!count($dispon)){
            $response=array(
                'code'=>1,
                'message'=>'No disponibilities found!',
                'errors'=>null,
                'result'=>null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        $data=$this->get('jms_serializer')->serialize($dispon,'json');
        $response=array(
            'code'=>0,
            'message'=>'success',
            'errors'=>null,
            'result'=>json_decode($data)
        );


        return new JsonResponse($response,200);
    }

}
