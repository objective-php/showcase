<?php

    namespace Showcase\Model;

    use Illuminate\Database\Eloquent\Model;
    use Sofa\Eloquence\Eloquence;
    use Sofa\Eloquence\Mappable;
    use Carbon\Carbon;

    /**
     * Class Employee
     *
     * @property Carbon  hire_date
     * @property Carbon  birth_date
     *
     * @package Showacse\Model
     */
    class Employee extends Model
    {

        use Eloquence, Mappable;

        protected $table = 'employees';

        public $timestamps = false;

        protected $maps = ['employee_no' => 'emp_no'];

        protected $appends = ['employee_no'];

        protected $casts = ['hire_date' => 'date', 'birth_date' => 'date'];
    }