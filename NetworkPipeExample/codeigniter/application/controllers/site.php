<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // load javascript        
        $this->load->library('javascript'); 
        
        // setup game engine udp port
        $this->gameEnginePort = 54321;
    }    
	
	public function index()
	{
        // get sounds from db
        $this->db->select('name,value');
        $query = $this->db->get('sounds');
        $data['sounds'] = array();
        foreach($query->result() as $row){
            $data['sounds'][$row->name] = $row->value;            
        }        
        
        // get ip addresses for game PCs
        $targets = array('DEMOFAM','DEVASTATION','localhost');
        foreach($targets as $target){
            $data['targets'][$target] = gethostbyname($target);
        }
        
        // get spawns from db
        $this->db->select('name,value');
        $query = $this->db->get('spawns');
        $data['spawns'] = array();
        foreach($query->result() as $row){
            $data['spawns'][$row->name] = $row->value;            
        } 
        
		$this->load->view('siteview',$data);        
	}
    
    public function run_command()
    {        
        $params = $this->input->post();
        //$retval = "last command = server: ".$params['server'].", command: ".$params['command'];
        if($params['command'] == "playSound" and isset($params['sound'])){
            $json_arr['command'] = array($params['command'] => $params['sound']);
            $params['json'] = json_encode($json_arr);            
      
            $this->_send_game_message($params);
      
            // return message to client
            //$retval = $retval.", sound: ".$params['sound'].", ".$params['json'];
        }
        //echo($retval."<br/>");
        if($params['command'] == "spawnNpc" and isset($params['objectref']) and isset($params['hostile']) and isset($params['count'])){
            $json_params = array();
            $json_params['objectref'] = $params['objectref'];
            $json_params['hostile'] = $params['hostile'];
            $json_params['count'] = $params['count'];
            $json_arr['command'] = array($params['command'] => $json_params);
            
            $params['json'] = json_encode($json_arr);
            
            $this->_send_game_message($params);
        }
        
        if($params['command'] == "showMessage" and isset($params['message'])){
            $json_arr['command'] = array($params['command'] => $params['message']);
            $params['json'] = json_encode($json_arr);            
      
            $this->_send_game_message($params);
        }
    }
    
    function _send_game_message($server_data)
    {
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        
        $msg = $server_data['json'];
        $len = strlen($msg);
        
        //echo($msg."<br/>");
        //echo($server_data['server']."<br/>");
        //echo($this->gameEnginePort."<br/>");

        socket_sendto($sock, $msg, $len, 0, $server_data['server'], $this->gameEnginePort);

        //socket_recvfrom($sock, $buf, 12, 0, '192.168.1.7', 11104);
        //echo $buf;        
        
        socket_close($sock);        
    }
}
