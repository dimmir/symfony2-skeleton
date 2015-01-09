<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\DBAL\Types\RoleType;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Fresh\Bundle\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * User
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 * @Gedmo\SoftDeleteable()
 * @UniqueEntity(fields={"email"}, errorPath="email", repositoryMethod="findNyEmailWithoutFilter")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @DoctrineAssert\Enum(entity="AppBundle\DBAL\Types\RoleType")
     * @ORM\Column(name="role", type="RoleType", nullable=false)
     */
    protected $role;

    /**
     * @ORM\Column(name="first_name", type="string", length=100, nullable=true)
     * @Assert\Length(max = "100")
     */
    protected $firstName;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="last_name", type="string", length=100, nullable=true)
     * @Assert\Length(max = "100")
     */
    protected $lastName;


    /**
     * Creation time.
     *
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * Last update time.
     *
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * Deleted time
     *
     * @var \DateTime
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function preModification()
    {
        $this->username = $this->getFullName();
        if (empty($this->username)) {
            $this->username = $this->email;
        }
        $this->usernameCanonical = uniqid();
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
     * Get full name
     *
     * @return string
     */
    public function getFullName()
    {
        return trim($this->getFirstName() . ' ' . $this->getLastName());
    }


    /**
     * Get full name with role
     *
     * @return string
     */
    public function getFullNameWithRole()
    {
        return $this->getFullName() . ' (' . RoleType::getReadableValue($this->getRole()) . ')';
    }

    /**
     * Set role
     *
     * @param string $role
     * 
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return array(RoleType::ROLE_DEFAULT, $this->role);
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return $this
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return $this
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}
