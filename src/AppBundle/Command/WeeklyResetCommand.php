<?php


namespace AppBundle\Command;

use AppBundle\Entity\Hunter;
use Sonata\CoreBundle\Tests\Entity\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class WeeklyResetCommand
 *
 * Define the command line beer:weekly:reset
 *
 * @package AppBundle\Command
 */
class WeeklyResetCommand extends ContainerAwareCommand
{
    /**
     * Configure the identity of the command line
     */
    protected function configure()
    {
        $this
            ->setName('beer:weekly:reset')
            ->setDescription('reset the weeklyScore of all hunters');
    }

    /**
     * When the command line is call, reset the weeklyScore of all the users
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $entityManager = $this->getContainer()->get('doctrine')->getEntityManager();

        $array = $em->getRepository('AppBundle:Hunter')
            ->findAll();

        /** @var Hunter $element */
        foreach($array as $element) {
            $element->setWeeklyScore(0);
        }
        $em->flush();
        $output->writeln('Done : reset all weeklyScore');
    }
}