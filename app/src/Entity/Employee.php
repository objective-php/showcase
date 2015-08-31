<?php

    namespace Entity;


    /**
     * @Entity
     * @Table(name="employees")
     */
    class Employee
    {
        /**
         * @Id
         * @Column(type="integer")
         */
        protected $emp_no;

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
         * @return mixed
         */
        public function getEmpNo()
        {
            return $this->emp_no;
        }

        /**
         * @param mixed $emp_no
         *
         * @return $this
         */
        public function setEmpNo($emp_no)
        {
            $this->emp_no = $emp_no;

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