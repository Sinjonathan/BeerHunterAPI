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

class PasswordController extends Controller
{
    /**
     * @Route("/salt", name="Salt and save a new password")
     * @Method({"POST"})
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Salt and save a new password",
     *  parameters={
     *      {"name"="_password", "dataType"="string", "required"=true, "description"="User new password"},
     *      {"name"="_id", "dataType"="int", "required"=true, "description"="User id"}
     *  }
     * )
     *
     * @param Request $request
     * @return null|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function saltPasswordAction(Request $request) {

        if (!($request->request->has('_password') && $request->request->has('_id'))) {
            throw new HttpException(400, "Parameters required !");
        }

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->get('doctrine')->getEntityManager();
        $repository = $em->getRepository('AppBundle:Hunter');

        $id = $request->get('_id');
        $password = $request->get('_password');
        /** @var Hunter $user */
        $user = $repository->findOneById($id);

        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        $password = $encoder->encodePassword($password, $user->getSalt());

        $user->setPassword($password);

        $em->persist($user);
        $em->flush();

        return new JsonResponse('OK');
    }
}