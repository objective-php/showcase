<?php

    namespace Entity;

    /**
     * @Entity
     * @Table("salaries")
     * @Index(name="salary_emp_no", columns={"emp_no"})
     *
     * @package Entity
     */
    class Salary extends AbstractEntity
    {
        /**
         * @Id
         * @Column(type="integer")
         * @GeneratedValue(strategy="AUTO")
         */
        protected $id;

        /**
         * @ManyToOne(targetEntity="Entity\Employee", inversedBy="salaries")
         * @JoinColumn(name="emp_no", referencedColumnName="emp_no")
         */
        protected $employee;

        /**
         * @Column(type="date", name="from_date")
         */
        protected $from;

        /**
         * @Column(type="date", name="to_date")
         */
        protected $to;

        /**
         * @Column(type="integer", name="salary")
         */
        protected $amount;

        /**
         * @return mixed
         */
        public function getEmployee()
        {
            return $this->employee;
        }

        /**
         * @param mixed $employee
         *
         * @return $this
         */
        public function setEmployee($employee)
        {
            $this->employee = $employee;

            return $this;
        }

        /**
         * @return mixed
         */
        public function getFrom()
        {
            return $this->from;
        }

        /**
         * @param mixed $from
         *
         * @return $this
         */
        public function setFrom($from)
        {
            $this->from = $from;

            return $this;
        }

        /**
         * @return mixed
         */
        public function getTo()
        {
            return $this->to;
        }

        /**
         * @param mixed $to
         *
         * @return $this
         */
        public function setTo($to)
        {
            $this->to = $to;

            return $this;
        }

        /**
         * @return mixed
         */
        public function getAmount()
        {
            return $this->amount;
        }

        /**
         * @param mixed $amount
         *
         * @return $this
         */
        public function setAmount($amount)
        {
            $this->amount = $amount;

            return $this;
        }

    }