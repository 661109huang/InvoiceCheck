<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function check_invoice()
    {
        // 初始中獎
        $bonus = array("安慰獎", "幫QQ");

        // 表單驗證類
        $this->load->library("form_validation");
        $this->form_validation->set_error_delimiters("", "");
        //驗證規則
        $this->form_validation->set_rules("invoice_number", "發票號碼", "trim|required|numeric|exact_length[8]");
        if ($this->form_validation->run() == FALSE) {
            // 驗證失敗
            $msg = $this->form_validation->error_string();
        } else {
            // 接收的發票號碼
            $invoice_number = $this->input->post('invoice_number');
            // 接收的對獎期數
            $invoice_date = $this->input->post('invoice_date');
            // 抓發票各期數中獎資料
            $xml = simplexml_load_file("https://invoice.etax.nat.gov.tw/invoice.xml", "SimpleXMLElement", LIBXML_NOCDATA);
            // 轉陣列
            $invoice_data = json_decode((json_encode($xml->channel)), true);
            // 獎項分出來
            $description = explode("</p><p>", $invoice_data["item"][$invoice_date]["description"]);

            foreach ($description as $value) {
                // 再把號碼跟獎項分出來        
                $awards = explode("：", preg_replace("/<p>|<\/p>+/u", "", $value));
                // 開始對獎
                switch ($awards[0]) {
                    case '特別獎':
                        if ($invoice_number == $awards[1]) $bonus = array("特別獎", "1,000萬元");
                        break;
                    case '特獎':
                        if ($invoice_number == $awards[1]) $bonus = array("特獎", "200萬元");
                        break;
                    case '頭獎':
                        // 頭獎有三個號碼，先拆出來
                        $awards_number = explode("、", $awards[1]);
                        foreach ($awards_number as $value) {
                            switch ($value) {
                                case ($invoice_number):
                                    $bonus = array("頭獎", "20萬元");
                                    break;
                                case (substr($invoice_number, -7) == substr($value, -7)):
                                    $bonus = array("二獎", "4萬元");
                                    break;
                                case (substr($invoice_number, -6) == substr($value, -6)):
                                    $bonus = array("三獎", "1萬元");
                                    break;
                                case (substr($invoice_number, -5) == substr($value, -5)):
                                    $bonus = array("四獎", "4千元");
                                    break;
                                case (substr($invoice_number, -4) == substr($value, -4)):
                                    $bonus = array("五獎", "1千元");
                                    break;
                                case (substr($invoice_number, -3) == substr($value, -3)):
                                    $bonus = array("六獎", "2百元");
                                    break;
                            }
                        }
                        break;
                    case '增開六獎':
                        if (substr($invoice_number, -3) == $awards[1]) $bonus = array("增開六獎", "2百元");
                        break;
                }
            }
            $msg = "恭喜獲得：" . $bonus[0] . "\n\r獎品為：" . $bonus[1];
        }
        echo $msg;
    }
}
