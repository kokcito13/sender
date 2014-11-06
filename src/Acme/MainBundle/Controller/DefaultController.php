<?php

namespace Acme\MainBundle\Controller;

use Acme\MainBundle\Entity\InProces;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package Acme\MainBundle\Controller
 * @Route("/m")
 *
 */
class DefaultController extends Controller
{
    /**
     * @Route("/name/{name}", name="main_m_index")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/send", name="main_m_send")
     */
    public function sendItemAction()
    {
        $em = $this->getDoctrine()->getManager();

        try {
            /** @var InProces $entity */
            $entity = $em->getRepository('AcmeMainBundle:InProces')->findOneBy(array(),array('createdAt'=>'DESC'));
        } catch(\Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $html = $entity->getHtml();
        $mails = explode(PHP_EOL, $entity->getToWho());
        foreach ($mails as $k=>$mail) {
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $failures = array();
                try {
                    $message = \Swift_Message::newInstance()
                        ->setSubject($entity->getSubject())
                        ->setFrom($entity->getFromWho(), $entity->getProjectName())
                        ->setTo($mail)
                        ->setBody($html, 'text/html')
                    ;
                    if ($this->get('mailer')->send($message, $failures)) {
                        //Succes send
                        echo 'Done';
                    } else {
                        $entity->setErrors($entity->getErrors().' - '.join(PHP_EOL, $failures).' - '.$mail);
                    }
                } catch(\Exception $e) {
                    $entity->setErrors($entity->getErrors().' - '.$e->getMessage().' - '.$mail);
                }
            } else {
                $entity->setErrors($entity->getErrors().' - Email не корректный! - '.$mail);
            }
            unset($mails[$k]);
            break;
        }
        $entity->setToWho(join(PHP_EOL,$mails));
        $em->persist($entity);
        $em->flush();
        var_dump($entity->getId());

        return new Response('new');
    }
}
