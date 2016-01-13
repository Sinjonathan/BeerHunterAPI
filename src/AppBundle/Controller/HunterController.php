<?php

namespace AppBundle\Controller;
use Dunglas\ApiBundle\JsonLd\Response;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response as RSP;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class HunterController extends Controller
{
    /**
     * @Route("/post_user", name="Add an user")
     * @Method({"POST"})
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Create a new user",
     *  parameters={
     *      {"name"="_username", "dataType"="string", "required"=true, "description"="User name"},
     *      {"name"="_password", "dataType"="string", "required"=true, "description"="User password"},
     *      {"name"="_email", "dataType"="string", "required"=true, "description"="User email"}
     *  }
     * )
     *
     * @param Request $request
     * @return null|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postUserAction(Request $request) {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');
        if (!($request->request->has('_username') && $request->request->has('_email') && $request->request->has('_password'))) {
            throw new HttpException(400, "Parameters required !");
        }

        $username = $request->request->get('_username');
        $email = $request->request->get('_email');
        $password = $request->request->get('_password');


        if (!($userManager->findUserByEmail($email) === null)){
            throw new HttpException(400, "Email exist !");
        }

        if (!($userManager->findUserByUsername($username) === null)){
            throw new HttpException(400, "User exist !");
        }

        $user = $userManager->createUser();
        $pwdFactory = $this->get('security.encoder_factory');
        $encoder = $pwdFactory->getEncoder($user);
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
        $user->setEnabled(true);
        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }
        $form = $formFactory->createForm();
        $form->setData($user);
        $form->handleRequest($request);
        $event = new FormEvent($form, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
        $userManager->updateUser($user);
        if (null === $response = $event->getResponse()) {
            $url = $this->generateUrl('fos_user_registration_confirmed');
            $response = new RedirectResponse($url);
        }
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
        return $response;
    }

    /**
     * @Route("/post_login", name="Log the user")
     * @Method({"POST"})
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Log a user",
     *  parameters={
     *      {"name"="_username", "dataType"="string", "required"=true, "description"="User name"},
     *      {"name"="_password", "dataType"="string", "required"=true, "description"="User password"}
     *  }
     * )
     *
     * @param Request $request
     * @return null|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postLoginAction(Request $request) {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $em = $this->getDoctrine()->getManager();

        if (!($request->request->has('_username') && $request->request->has('_password'))) {
            throw new HttpException(400, "Parameters required !");
        }

        $username = $request->request->get('_username');
        $password = $request->request->get('_password');

        $user = $em->getRepository('AppBundle:Hunter')->findByUsername($username)[0];
        if ($user === null){
            throw new HttpException(400, "User not exist !");
        }

        $pwdFactory = $this->get('security.encoder_factory');

        $encoder = $pwdFactory->getEncoder($user);

        if($encoder->IsPasswordValid($user->getPassword(),$password,$user->getSalt())) {
            $user->setOnline(true);
            $em->flush();
        } else {
            throw new HttpException(400, "Error in couple login/password !");
        }

        return new RSP();
    }

    /**
     * @Route("/post_logout", name="Disconnect the user")
     * @Method({"POST"})
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Disconnect a user",
     *  parameters={
     *      {"name"="_username", "dataType"="string", "required"=true, "description"="User name"}
     *  }
     * )
     *
     * @param Request $request
     * @return null|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postLogoutAction(Request $request) {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $em = $this->getDoctrine()->getManager();

        if (!($request->request->has('_username'))) {
            throw new HttpException(400, "Parameters required !");
        }

        $username = $request->request->get('_username');

        $user = $em->getRepository('AppBundle:Hunter')->findByUsername($username)[0];
        if ($user === null){
            throw new HttpException(400, "User not exist !");
        }

        if($user->IsOnline()) {
            $user->setOnline(false);
            $em->flush();
        } else {
            throw new HttpException(400, "Already disconnect");
        }

        return new RSP();
    }
}
