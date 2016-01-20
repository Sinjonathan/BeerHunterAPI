<?php

namespace AppBundle\Command;

use AppBundle\Entity\Hunter;
use Sonata\CoreBundle\Tests\Entity\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class WeeklyRewardCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('beer:weekly:top')
            ->setDescription('get the top 10 of user for this week');
    }

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