<?php

    namespace Entity;

    use Doctrine\Common\Collections\ArrayCollection;


    /**
     * @Entity
     * @Table(name="employees")
     */
    class Employee extends AbstractEntity
    {
        /**
         * @Id
         * @Column(type="integer", name="emp_no")
         */
        protected $employeeNo;

        /**
         * @Column(type="date", name="birth_date")
         */
        protected $birthDate;

        /**
         * @Column(type="string", name="first_name")
         */
        protected $firstName;

        /**
         * @Column(type="string", name="last_name")
         */
        protected $lastName;

        /**
         * @Column(type="string")
         */
        protected $gender;

        /**
         * @Column(type="date", name="hire_date")
         */
        protected $hireDate;

        /**
         * @OneToMany(targetEntity="Entity\Salary", mappedBy="employee")
         * @OrderBy({"from" = "ASC"})
         * @var ArrayCollection
         */
        protected $salaries;

        /**
         * @OneToMany(targetEntity="Entity\Title", mappedBy="employee")
         * @OrderBy({"from" = "ASC"})
         * @var ArrayCollection
         */
        protected $titles;

        public function __construct()
        {
            $this->salaries = new ArrayCollection();
        }

        /**
         * @return mixed
         */
        public function getEmployeeNo()
        {
            return $this->employeeNo;
        }

        /**
         * @param mixed $employeeNo
         *
         * @return $this
         */
        public function setEmployeeNo($employeeNo)
        {
            $this->employeeNo = $employeeNo;

            return $this;
        }

        /**
         * @return mixed
         */
        public function getBirthDate()
        {
            return $this->birthDate;
        }

        /**
         * @param mixed $birthDate
         *
         * @return $this
         */
        public function setBirthDate($birthDate)
        {
            $this->birthDate = $birthDate;

            return $this;
        }

        /**
         * @return mixed
         */
        public function getFirstName()
        {
            return $this->firstName;
        }

        /**
         * @param mixed $firstName
         *
         * @return $this
         */
        public function setFirstName($firstName)
        {
            $this->firstName = $firstName;

            return $this;
        }

        /**
         * @return mixed
         */
        public function getLastName()
        {
            return $this->lastName;
        }

        /**
         * @param mixed $lastName
         *
         * @return $this
         */
        public function setLastName($lastName)
        {
            $this->lastName = $lastName;

            return $this;
        }

        /**
         * @return mixed
         */
        public function getGender()
        {
            return $this->gender;
        }

        /**
         * @param mixed $gender
         *
         * @return $this
         */
        public function setGender($gender)
        {
            $this->gender = $gender;

            return $this;
        }

        /**
         * @return mixed
         */
        public function getHireDate()
        {
            return $this->hireDate;
        }

        /**
         * @param mixed $hireDate
         *
         * @return $this
         */
        public function setHireDate($hireDate)
        {
            $this->hireDate = $hireDate;

            return $this;
        }


    }