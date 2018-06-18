<?php
class TrafficPainter {
	protected $defaultDates;
	protected $traffic;
	protected $tDates;
	function __construct($parsing) {
		$this->defaultDates=array(date('Y-m-d',mktime(0, 0, 0, date("m")-6, 1, date("Y")))=>0,
								date('Y-m-d',mktime(0, 0, 0, date("m")-5, 1,   date("Y")))=>0,
								date('Y-m-d',mktime(0, 0, 0, date("m")-4, 1,   date("Y")))=>0,
								date('Y-m-d',mktime(0, 0, 0, date("m")-3, 1,   date("Y")))=>0,
								date('Y-m-d',mktime(0, 0, 0, date("m")-2, 1,   date("Y")))=>0,
								date('Y-m-d',mktime(0, 0, 0, date("m")-1, 1,   date("Y")))=>0);
		if(is_array($jSontraffic=$parsing)) {
			foreach ($jSontraffic as $key => $value) {
				$traffic[] = $value;
				$this->tDates[]=$key;
			}
			$this->traffic = $traffic;
		}
		else
		{
			$this->traffic=array(0,0,0,0,0,0);
			foreach ($this->defaultDates as $key=>$value)
			{
				$this->tDates[]=$key;
			}
		}

	}
	public function getTDates()
	{
		return json_encode($this->tDates);
	}

	public function getTraffic()
	{
		return json_encode($this->traffic);
	}
}