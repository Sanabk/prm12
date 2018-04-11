<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation as Http;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\View\RouteRedirectView;
use Symfony\Component\HttpFoundation\Response;
use Hateoas\Configuration\Annotation as Hateoas;

class RegisterController extends Controller
{
    public function registerAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $em = $this->getDoctrine()->getManager();
        $data = $request->request->all();

        // Do a check for existing user with userManager->findByUsername

        $user = $userManager->createUser();
        $user->setUsername($data['username']);
        $user->setemail($data['email']);
        $user->setPlainPassword($data['password']);
        $user->setEnabled(true);

        $userManager->updateUser($user);

        return $this->generateToken($user, 201);
    }
    protected function generateToken($user, $statusCode = 200)
    {
        // Generate the token
        $token = $this->get('lexik_jwt_authentication.jwt_manager')->create($user);

        $response = array(
            'token' => $token,
            'user'  => $user // Assuming $user is serialized, else you can call getters manually
        );

        return new JsonResponse($response, $statusCode); // Return a 201 Created with the JWT.
    }
    /**
     *
     * @ApiDoc(
     *     resource=true,
     *     description="show all users"
     * )
     * @Route("/api/users", name="user_s_list")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
        $data = $this->get('jms_serializer')->serialize($users, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;



    }

}
