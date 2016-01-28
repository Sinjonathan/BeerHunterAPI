<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class FilterController extends Controller
{

    /**
     * @Route("/post_hunt_filter", name="Get the filtered hunts list")
     * @Method({"POST"})
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Give filter to get list of hunts",
     *  parameters={
     *      {"name"="bar", "dataType"="integer", "required"=false, "description"="The id of the bar"},
     *      {"name"="beer", "dataType"="integer", "required"=false, "description"="The id of the beer"},
     *      {"name"="color", "dataType"="integer", "required"=false, "description"="The id of the color"},
     *      {"name"="origin", "dataType"="integer", "required"=false, "description"="The id of the origin"},
     *      {"name"="pressure", "dataType"="boolean", "required"=false, "description"="The beer is pressure or not"},
     *      {"name"="price_min", "dataType"="integer", "required"=false, "description"="The minimum price"},
     *      {"name"="price_max", "dataType"="integer", "required"=false, "description"="The maximum price"},
     *      {"name"="degree_max", "dataType"="integer", "required"=false, "description"="The maximum degree"},
     *      {"name"="degree_min", "dataType"="integer", "required"=false, "description"="The minimum degree"}
     *  }
     * )
     *
     * @param Request $request
     * @return Response
     */
    public function getHuntFilterAction(Request $request) {

        $where = '';

        $beer = null;
        $color = null;
        $origin = null;
        $pressure = null;
        $status = 0;
        $priceMin = 0;
        $priceMax = 100;
        $degreeMin = 0;
        $degreeMax = 100;

        $where = $where . ' h.beer = b.id and';
        $where = $where . ' h.price >= :priceMin and';
        $where = $where . ' h.price < :priceMax and';
        $where = $where . ' b.degree >= :degreeMin and';
        $where = $where . ' b.degree < :degreeMax and';
        $where = $where . ' h.status = :status and';

        if($request->request->has('beer')) {
            $beer = $request->get('beer');
            $where = $where . ' h.beer = :beer and';
        }

        if($request->request->has('color')) {
            $color = $request->get('color');
            $where = $where . ' b.color = :color and';
        }

        if($request->request->has('origin')) {
            $origin = $request->get('origin');
            $where = $where . ' b.origin = :origin and';
        }

        if($request->request->has('pressure')) {
            $pressure = $request->get('pressure');
            $where = $where . ' h.isPressure = :pressure and';
        }

        if($request->request->has('price_min')) {
            $priceMin = $request->get('price_min');
        }

        if($request->request->has('price_max')) {
            $priceMax = $request->get('price_max');
        }

        if($request->request->has('degree_min')) {
            $degreeMin = $request->get('degree_min');
        }

        if($request->request->has('degree_max')) {
            $degreeMax = $request->get('degree_max');
        }

        if($request->request->has('status')) {
            $status = $request->get('status');
        }

        $where = substr($where, 0, -3);

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->get('doctrine')->getEntityManager();

        $repo = $em->getRepository('AppBundle:Hunt')->createQueryBuilder('h');

        $repo
            ->join('AppBundle\Entity\Beer','b')
            ->where($where)
            ->setParameter('priceMin', $priceMin)
            ->setParameter('priceMax', $priceMax)
            ->setParameter('degreeMin', $degreeMin)
            ->setParameter('degreeMax', $degreeMax)
            ->setParameter('status', $status);

        if($pressure !== null) {
            $repo->setParameter('pressure', $pressure);
        }

        if($color !== null) {
            $repo->setParameter('color', $color);
        }

        if($beer !== null) {
            $repo->setParameter('beer', $beer);
        }

        if($origin !== null) {
            $repo->setParameter('origin', $origin);
        }

        if($status !== null) {
            $repo->setParameter('status', $status);
        }

        $query = $repo->getQuery();

        $hunts = $query->getResult();

        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setIgnoredAttributes(array('timezone','origin','hunter','votes'));
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serialized = null;
        $serializer = new Serializer(array($normalizer), array($encoder));
        $serialized = $serializer->serialize($hunts, 'json');

        $response = new Response();
        $response->setContent($serialized);

        return $response;
    }
}