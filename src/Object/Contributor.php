<?php

namespace Tuto\Object;

class Contributor
{
    /**
     *
     * @var \Tuto\Object\Contributor\Statistics
     */
    public $statistics;
    
    /**
     *
     * @var \Tuto\Client
     */
    private $master;
    
    /**
     *
     * @var string 
     */
    private $endpoint = 'contributor';
    
    public function __construct(\Tuto\Client $master)
    {
        $this->master = $master;
        $this->statistics = new Contributor\Statistics($this->master);
    }
    
    /**
     * 
     * @param string type of stats
     * @return mixed
     */
    public function statistics($type = '')
    {
        if(isset($type) && !empty($type))
        {
            if(method_exists($this->statistics, $type))
            {
                return $this->statistics->$type();
            }
        }
        else
        {
            return $this->statistics->common();
        }
    }
    
    /**
     * @return mixed
     */
    public function infos()
    {
        $_params = array();
        return $this->master->call('get',$this->endpoint.'/infos',$_params);
    }

}