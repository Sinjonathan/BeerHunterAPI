<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hunter;
use Dunglas\ApiBundle\JsonLd\Response;
use Sonata\CoreBundle\Tests\Entity\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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

        $userManager = $this->get('fos_user.user_manager');
        if (!($request->request->has('_username') && $request->request->has('_email') && $request->request->has('_password'))) {
            throw new HttpException(400, "Parameters required !");
        }

        $username = $request->get('_username');
        $password = $request->get('_password');
        $email= $request->get('_email');

        // Verify if the users email or the user name are already used

        if (!($userManager->findUserByEmail($email) === null)){
            throw new HttpException(480, "Email exist !");
        }

        if (!($userManager->findUserByUsername($username) === null)){
            throw new HttpException(481, "User exist !");
        }

        // Create a new user and set its parameters

        /** @var Hunter $user */
        $user = $userManager->createUser();

        $factory = $this->get('security.encoder_factory');

        $encoder = $factory->getEncoder($user);
        $password = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($password);
        $user->setUsername($username);
        $user->setUsernameCanonical($username);
        $user->setEmail($email);
        $user->setEmailCanonical($email);
        $user->setEnabled(true);
        $user->setLocked(false);
        $user->setExpired(false);

        $user->setCredentialsExpired(false);

        // Persist the new user

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->get('doctrine')->getEntityManager();
        $em->persist($user);
        $em->flush();

        return new JsonResponse('Register OK');
    }
}
