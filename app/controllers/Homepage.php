<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = array();

		// 抓發票各期數中獎資料
		$xml = simplexml_load_file("https://invoice.etax.nat.gov.tw/invoice.xml", 'SimpleXMLElement', LIBXML_NOCDATA);
		// 轉陣列
		$data["invoice_data"] = json_decode((json_encode($xml->channel)), true);

		$this->load->view("homepage", $data);
	}
}
