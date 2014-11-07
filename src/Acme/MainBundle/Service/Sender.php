<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/7/14
 * Time: 12:56 AM
 */

namespace Acme\MainBundle\Service;

use Acme\MainBundle\Entity\InProces;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\Request;
use Swift_Message;

class Sender {
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var
     */
    protected $mailer;

    /**
     * @var
     */
    protected $em;

    /**
     * @param $em
     * @param Container $container
     * @param $mailer
     */
    public function __construct($em, Container $container, $mailer)
    {
        $this->container = $container;
        $this->mailer = $mailer;
        $this->em = $em;
    }


    public function send()
    {
        $em = $this->em;

        try {
            /** @var InProces $entity */
            $entity = $em->getRepository('AcmeMainBundle:InProces')->findOneBy(array(),array('createdAt'=>'DESC'));
        } catch(\Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $mailsString = trim($entity->getToWho());
        if (empty($mailsString)) {
            return;
        }
        $html = $entity->getHtml();
        $mails = explode(PHP_EOL, $mailsString);
        foreach ($mails as $k=>$mail) {
            $mail = trim($mail);
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $failures = array();
                try {
                    $message = \Swift_Message::newInstance()
                        ->setSubject($entity->getSubject())
                        ->setFrom($entity->getFromWho(), $entity->getProjectName())
                        ->setTo($mail)
                        ->setBody($html, 'text/html')
                    ;
                    if ($this->mailer->send($message, $failures)) {
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
    }
} 