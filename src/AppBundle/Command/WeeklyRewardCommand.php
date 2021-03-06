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
 * Class WeeklyRewardCommand
 *
 * Define the command line beer:weekly:top
 *
 * @package AppBundle\Command
 */
class WeeklyRewardCommand extends ContainerAwareCommand
{
    /**
     * Configure the identity of the command line
     */
    protected function configure()
    {
        $this
            ->setName('beer:weekly:top')
            ->setDescription('get the top 10 of user for this week');
    }

    /**
     * When the command line is call, output the 10 best hunters according to there WeeklyScore
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
            ->findTop();

        $output->writeln('***** TOP 10 HUNTER *****');

        /** @var Hunter $element */
        foreach($array as $element) {
            $output->writeln($element->getUsername() . ' [' . $element->getEmail() . '] : ' . $element->getWeeklyScore() . ' pts');
        }
    }
}