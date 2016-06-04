<?php
/**
 * @package AppBundle\Command
 */

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GoogleApiCommand
 */
class GoogleApiCommand extends ContainerAwareCommand
{
  /**
   * @return null
   */
    protected function configure()
    {
        $this->setName('google:data:receive');
        $this->setDescription('Receive one batch of Google Analytics Data');

        return null;
    }

  /**
   * @param InputInterface  $input  Input of command.
   * @param OutputInterface $output Output of command.
   * @return boolean
   */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('app.googleapi.service')->getData();
    
        return true;
    }
}
