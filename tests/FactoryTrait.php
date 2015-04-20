<?php

trait FactoryTrait {

    protected $times = 1;

    /**
     * @param $number
     * @return $this
     */
    protected function times($number)
    {
        $this->times = $number;

        return $this;
    }

    /**
     * @param $type
     * @param array $record
     * @throws Exception
     */
    public function create($type, array $record = [])
    {
        while($this->times--) {
            $type::create(
                array_merge($this->getStub(), $record)
            );
        }
    }

    /**
     * @throws Exception
     */
    public function getStub()
    {
        throw new Exception('Implement getStub method to be able to create a record.');
    }
}