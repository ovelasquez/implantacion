<?php
namespace CDI\EnfermeriaBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity
 */
class Usuarios extends BaseUser
{
     /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
     public function __construct()
    {
        parent::__construct();
        
    }
       
    /**
     * @var \Datos
     *
     * @ORM\ManyToOne(targetEntity="CDI\EnfermeriaBundle\Entity\Datos", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="datos_id", referencedColumnName="id")
     * })
     */
    protected $datos;
    
     /**
     * @ORM\ManyToMany(targetEntity="CDI\EnfermeriaBundle\Entity\Group")
     * @ORM\JoinTable(name="usuarios_group",
     *      joinColumns={@ORM\JoinColumn(name="usuarios_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;
    

    /**
     * Set datos
     *
     * @param \CDI\EnfermeriaBundle\Entity\Datos $datos
     *
     * @return Usuarios
     */
    public function setDatos(\CDI\EnfermeriaBundle\Entity\Datos $datos = null)
    {
        $this->datos = $datos;

        return $this;
    }

    /**
     * Get datos
     *
     * @return \CDI\EnfermeriaBundle\Entity\Datos
     */
    public function getDatos()
    {
        return $this->datos;
    }
}
