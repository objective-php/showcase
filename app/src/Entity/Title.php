<?php

    namespace Showcase\Entity;

    use Showcase\Entity\Employee;

    /**
     * @Entity
     * @Table(name="titles")
     */
    class Title extends AbstractEntity
    {
        /**
         * @Id
         * @Column(type="integer")
         * @GeneratedValue(strategy="AUTO")
         */
        protected $id;

        /**
         * @ManyToOne(targetEntity="Showcase\Entity\Employee", inversedBy="titles")
         * @JoinColumn(name="emp_no", referencedColumnName="emp_no")
         *
         * @var Employee
         */
        protected $employee;

        /**
         * @Column(type="string")
         *
         * @var string
         */
        protected $title;


        /**
         * @Column(type="date", name="from_date")
         *
         * @var \DateTime
         */
        protected $from;

        /**
         * @Column(type="date", name="to_date")
         *
         * @var \DateTime
         */
        protected $to;

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return Showcase\Entity\Employee
         */
        public function getEmployee()
        {
            return $this->employee;
        }

        /**
         * @param Showcase\Entity\Employee $employee
         *
         * @return $this
         */
        public function setEmployee($employee)
        {
            $this->employee = $employee;

            return $this;
        }

        /**
         * @return string
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * @param string $title
         *
         * @return $this
         */
        public function setTitle($title)
        {
            $this->title = $title;

            return $this;
        }

        /**
         * @return \DateTime
         */
        public function getFrom()
        {
            return $this->from;
        }

        /**
         * @param \DateTime $from
         *
         * @return $this
         */
        public function setFrom($from)
        {
            $this->from = $from;

            return $this;
        }

        /**
         * @return \DateTime
         */
        public function getTo()
        {
            return $this->to;
        }

        /**
         * @param \DateTime $to
         *
         * @return $this
         */
        public function setTo($to)
        {
            $this->to = $to;

            return $this;
        }



    }