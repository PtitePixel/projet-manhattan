<?php

/**
 * Description of UserModels
 *
 * @author Luxbay
 */

//USE
use Symfony\Component\Security\Core\User\UserInterface;


class UserModels {

    /**
     * @Id()
     * @GeneratedValue()
     * @Column(name="usr_id", type="integer", nullable=false)
     */
    protected $id;

    /**
     * @Column(name="usr_firstname", type="string", length=50, nullable=false)
     */
    private $firstname;

    /**
     * @Column(name="usr_lastname", type="string", length=50, nullable=false)
     */
    private $lasttname;
    
    /**
     * @Column(name="usr_birthday", type="string", nullable=false)
     */
    private $birthday;

    /**
     * @Column(name="usr_email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @Column(name="usr_telephone", type="string", length=50, nullable=false)
     */
    private $telephone;

    /**
     * @Column(name="usr_loginname", type="integer", length=30, nullable=false)
     */
    private $loginname;

    /**
     * @Column(name="usr_password", type="string", length=50, nullable=false)
     */
    private $password;

    /**
     * @Column(name="usr_street", type="string", length=50, nullable=false)
     */
    private $street;

    /**
     * @Column(name="usr_nummber", type="string", length=10, nullable=false)
     */
    private $nummber;

    /**
     * @Column(name="usr_city", type="string", length=30, nullable=false)
     */
    private $city;

    /**
     * @Column(name="usr_zip", type="string", length=50, nullable=false)
     */
    private $zip;

    /**
     * @Column(name="usr_country", type="string", length=50, nullable=false)
     */
    private $country;

    /**
     * @Column(name="usr_update", type="string", length=15, nullable=false)
     */
    private $update;

    /**
     * @ManyToMany(targetEntity="Models\Role")
     * @JoinTable(name="users_roles",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="role_id", referencedColumnName="id")}
     *  )
     */
    private $roles = [];

    function addRole(Role $role) {
        if (in_array($role, $this->roles)) {
            return $this;
        }

        $this->roles[] = $role;
        return $this;
    }

    /**
     * Getter
     */
    function getId() {
        return $this->id;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLasttname() {
        return $this->lasttname;
    }
    
    function getEmail() {
        return $this->email;
    }

    function getBirthday() {
        return $this->birthday;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getLoginname() {
        return $this->loginname;
    }

    function getPassword() {
        return $this->password;
    }

    function getStreet() {
        return $this->street;
    }

    function getNummber() {
        return $this->nummber;
    }

    function getCity() {
        return $this->city;
    }

    function getZip() {
        return $this->zip;
    }

    function getCountry() {
        return $this->country;
    }

    function getUpdate() {
        return $this->update;
    }

    function setId($id) {
        $this->id = $id;
    }

       // getRoles
    public function getRoles() {
        $roles = [];
        foreach ($this->roles as $role) {
            $roles[] = $role->getLabel();
        }

        return $roles;
    }

    /**
     * Setter
     */
    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLasttname($lasttname) {
        $this->lasttname = $lasttname;
    }
    
    function setBirthday() {
        $this->birthday = $birthday;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function setLoginname($loginname) {
        $this->loginname = $loginname;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setStreet($street) {
        $this->street = $street;
    }

    function setNummber($nummber) {
        $this->nummber = $nummber;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setZip($zip) {
        $this->zip = $zip;
    }

    function setCountry($country) {
        $this->country = $country;
    }

    function setUpdate($update) {
        $this->update = $update;
    }

    // setRoles
    function setRoles(array $roles) {
        $this->roles = [];
        foreach ($roles as $role) {
            $this->addRole($role);
        }
        return $this;
    }

}
