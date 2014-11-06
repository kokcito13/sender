<?php

namespace Acme\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InProces
 *
 * @ORM\Table(name="in_process")
 * @ORM\Entity(repositoryClass="Acme\MainBundle\Entity\InProcesRepository")
 */
class InProces
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="project_name", type="string", length=255)
     */
    private $projectName;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="from_who", type="string", length=255)
     */
    private $fromWho;

    /**
     * @var string
     *
     * @ORM\Column(name="html", type="text")
     */
    private $html;

    /**
     * @var string
     *
     * @ORM\Column(name="to_who", type="text")
     */
    private $toWho;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="errors", type="text")
     */
    private $errors;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->errors = '';
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set projectName
     *
     * @param string $projectName
     * @return InProces
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string 
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return InProces
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set fromWho
     *
     * @param string $fromWho
     * @return InProces
     */
    public function setFromWho($fromWho)
    {
        $this->fromWho = $fromWho;

        return $this;
    }

    /**
     * Get fromWho
     *
     * @return string 
     */
    public function getFromWho()
    {
        return $this->fromWho;
    }

    /**
     * Set html
     *
     * @param string $html
     * @return InProces
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string 
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set toWho
     *
     * @param string $toWho
     * @return InProces
     */
    public function setToWho($toWho)
    {
        $this->toWho = $toWho;

        return $this;
    }

    /**
     * Get toWho
     *
     * @return string 
     */
    public function getToWho()
    {
        return $this->toWho;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return InProces
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set errors
     *
     * @param string $errors
     * @return InProces
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * Get errors
     *
     * @return string 
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
