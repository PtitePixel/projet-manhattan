<?php

namespace Models;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Entity()
 * @Table(name="user")
 */
class UserModel implements UserInterface {

    /**
     * @Id()
     * @GeneratedValue()
     * @Column(name="usr_id", type="integer", nullable=false)
     */
    protected $id;

    /**
     * @Column(name="usr_firstname", type="string", length=30, nullable=false)
     */
    private $firstname;

    /**
     * @Column(name="usr_lastname", type="string", length=30, nullable=false)
     */
    private $lastname;

    /**
     * @Column(name="usr_email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @Column(name="usr_telephone", type="integer", length=30, nullable=false)
     */
    private $telephone;

    /**
     * @Column(name="usr_name", type="string", length=30, nullable=false)
     */
    private $username;

    /**
     * @Column(name="usr_password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @Column(name="usr_number", type="string", length=10, nullable=false)
     */
    private $number;

    /**
     * @Column(name="usr_street", type="string", length=80, nullable=false)
     */
    private $street;

    /**
     * @Column(name="usr_city", type="string", length=80, nullable=false)
     */
    private $city;

    /**
     * @Column(name="usr_zip", type="string", length=10, nullable=false)
     */
    private $zip;

    /**
     * @Column(name="usr_country", type="string", length=50, nullable=false)
     */
    private $country;

    /**
     * @ManyToMany(targetEntity="Models\Role")
     * @JoinTable(name="users_roles",
     *      joinColumns={@JoinColumn(name="use_id", referencedColumnName="usr_id")},
     *      inverseJoinColumns={@JoinColumn(name="role_id", referencedColumnName="id")}
     *  )
     */
    private $roles = [];

    // Getter see below for the username and password
    public function getId() {
        return $this->id;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getemail() {
        return $this->email;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getNumber(){
        return $this->number;
    }

    public function getStreet() {
        return $this->street;
    }

    public function getCity() {
        return $this->city;
    }

    public function getZip() {
        return $this->zip;
    }

    public function getCountry() {
        return $this->country;
    }

    // Setter
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
        return $this;
    }

    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public function setZip($zip) {
        $this->zip = $zip;
        return $this;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    function setRoles(array $roles) {
        $this->roles = [];
        foreach ($roles as $role) {
            $this->addRole($role);
        }
        return $this;
    }

    function addRole(Role $role) {
        if (in_array($role, $this->roles)) {
            return $this;
        }

        $this->roles[] = $role;
        return $this;
    }

    public function getRoles() {
        $roles = [];
        foreach ($this->roles as $role) {
            $roles[] = $role->getLabel();
        }

        return $roles;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'password' => $this->password,
            'roles' => $this->getRoles()
        ];
    }

    public function eraseCredentials() {
        return;
    }

    // Getter for password and username
    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return;
    }

    public function getUsername() {
        return $this->username;
    }

}
