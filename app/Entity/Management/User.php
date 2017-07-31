<?php

namespace App\Entity\Management;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * This class represents an User item, either an Admin or normal user.
 * It is abstract because we never have an User entity, it's either an admin or not.
 * @ORM\Entity(repositoryClass="\App\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap( {"admin" = "Admin" , "user" = "User"} )
 */
class User implements Authenticatable
{
    use Notifiable;

	/**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column( name="first_name", type="string", nullable=false)
     */
    protected $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", nullable=false)
     */
    protected $lastName;

    /**
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    protected $email;

    /**
     * @ORM\Column(name="username", type="string", nullable=false)
     */
    protected $username;

    /**
     * @ORM\Column(name="email_verified", type="boolean", nullable=false)
     */
    protected $emailVerified = false;

    /**
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    protected $password;

    /**
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    protected $active = false;

    /**
     * @ORM\Column(name="company_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    protected $companyId;

	/**
     * @ORM\Column(name="group_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="Group")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    protected $groupId = 0;

    /**
     * @ORM\Column(name="scope", type="string", length=2000)
     */
    protected $scope = "";

    /**
    * @ORM\ManyToMany(targetEntity="Region", inversedBy="users")
    * @ORM\JoinTable(name="region_users")
    * @var Region[]
    */
    private $regions;

    /**
     * @ORM\Column(name="profile_pic", type="string", nullable=true)
     */
    protected $profilePic;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;

    public function __construct() {
        $this->regions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get regions
     *
     * @return Region
     */
    public function getRegion()
    {
        return $this->regions;
    }

    /***** Getters and setters *****/

	/**
	 * Get entity values in an array format
	 *
	 * @return array
	 */
    public function getSimpleValues()
    {
		return array(
			'id'			=> $this->getId(),
			'username'		=> $this->getUsername(),
			'first_name'	=> $this->getFirstName(),
			'last_name'		=> $this->getLastName(),
			'email'			=> $this->getEmail(),
			'password'		=> $this->getPassword(),
			'active'		=> $this->getActive(),
			'company_id'	=> $this->getCompanyId(),
			'group_id'		=> $this->getGroupId(),
			'scope'			=> $this->getScope(),
			'created_at'	=> $this->getCreatedAt(),
			'updated_at'	=> $this->getUpdatedAt(),
			'deleted_at'	=> $this->getDeletedAt()
		);
	}

    /** Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
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
     * @return User
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
     * Set email
     *
     * @param string $email
     * @return User
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
     * Set email_verified
     *
     * @param boolean $email_verified
     * @return User
     */
    public function setEmailVerified($emailVerified)
    {
        $this->emailVerified = $emailVerified;

        return $this;
    }

    /**
     * Get email_verified
     *
     * @return boolean
     */
    public function getEmailVerified()
    {
        return $this->emailVerified;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

	/**
     * Set password
     *
     * @param string $password
     * @return User
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
     * Set active
     *
     * @param boolean $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

	/**
     * Set company_id
     *
     * @param integer $companyId
     * @return User
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

	/**
     * Set group_id
     *
     * @param integer $groupId
     * @return User
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * Get group_id
     *
     * @return integer
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Set scope
     *
     * @param string $scope
     * @return User
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope
     *
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }


    /**
     * Set profilePic
     *
     * @param string $profilePic
     * @return User
     */
    public function setProfilePic($profilePic)
    {
        $this->profilePic = $profilePic;

        return $this;
    }

    /**
     * Get profilePic
     *
     * @return string
     */
    public function getProfilePic()
    {
        return $this->profilePic;
    }

    /**
     * Get created_at
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get deleted_at
     *
     * @return datetime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set deleted_at
     *
     * @param integer $deletedAt
     * @return User
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        
    }

    public function setRememberToken($value)
    {
        
    }

    public function getRememberTokenName()
    {
        
    }

}
