<?php

namespace Lanparty\UsuariBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;


/**
 * Usuari
 * @ORM\Entity(repositoryClass="Lanparty\UsuariBundle\Entity\UsuariRepository")
 * @ORM\Table()
 * @ORM\Entity
 */


class Usuari implements UserInterface
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
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="cognoms", type="string", length=255)
     */
    private $cognoms;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="direccio", type="text")
     */
    private $direccio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="permet_email", type="boolean")
     */
    private $permetEmail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_alta", type="datetime")
     */
    private $dataAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_naixement", type="datetime")
     */
    private $dataNaixement;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=9)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="ciutat", type="string", length=255)
     */
    private $ciutat;


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
     * Set nom
     *
     * @param string $nom
     * @return Usuari
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set cognoms
     *
     * @param string $cognoms
     * @return Usuari
     */
    public function setCognoms($cognoms)
    {
        $this->cognoms = $cognoms;
    
        return $this;
    }

    /**
     * Get cognoms
     *
     * @return string 
     */
    public function getCognoms()
    {
        return $this->cognoms;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuari
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuari
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuari
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set direccio
     *
     * @param string $direccio
     * @return Usuari
     */
    public function setDireccio($direccio)
    {
        $this->direccio = $direccio;
    
        return $this;
    }

    /**
     * Get direccio
     *
     * @return string 
     */
    public function getDireccio()
    {
        return $this->direccio;
    }

    /**
     * Set permetEmail
     *
     * @param boolean $permetEmail
     * @return Usuari
     */
    public function setPermetEmail($permetEmail)
    {
        $this->permetEmail = $permetEmail;
    
        return $this;
    }

    /**
     * Get permetEmail
     *
     * @return boolean 
     */
    public function getPermetEmail()
    {
        return $this->permetEmail;
    }

    /**
     * Set dataAlta
     *
     * @param \DateTime $dataAlta
     * @return Usuari
     */
    public function setDataAlta($dataAlta)
    {
        $this->dataAlta = $dataAlta;
    
        return $this;
    }

    /**
     * Get dataAlta
     *
     * @return \DateTime 
     */
    public function getDataAlta()
    {
        return $this->dataAlta;
    }

    /**
     * Set dataNaixement
     *
     * @param \DateTime $dataNaixement
     * @return Usuari
     */
    public function setDataNaixement($dataNaixement)
    {
        $this->dataNaixement = $dataNaixement;
    
        return $this;
    }

    /**
     * Get dataNaixement
     *
     * @return \DateTime 
     */
    public function getDataNaixement()
    {
        return $this->dataNaixement;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return Usuari
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    
        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set ciutat
     *
     * @param string $ciutat
     * @return Usuari
     */
    public function setCiutat($ciutat)
    {
        $this->ciutat = $ciutat;
    
        return $this;
    }

    /**
     * Get ciutat
     *
     * @return string 
     */
    public function getCiutat()
    {
        return $this->ciutat;
    }
    
    public function __toString()
    {
        return $this->getNom().' '.$this->getCognoms();
    }

    public function __construct()
    {
        $this->data_alta = new \DateTime();
    }

    function eraseCredentials()
    {
    }
    
    function getRoles()
    {
        return array('ROLE_USUARI');
    }
    
    function getUsername()
    {
        return $this->getEmail();
    }

    
}
