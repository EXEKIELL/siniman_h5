<?php

class ActivityAction extends Action{

    public function __construct()
    {
        parent::__construct();
        $this->assign('path', 'http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/index.php');
//        $this->assign('top_path', 'http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/topics.php');

        $this->assign('top_path', 'http://www.snimay.com/mobile.php/Meet/books');
        $this->assign('imgLink', 'http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/Topics/Tpl/');
    }
    function index(){
        $from=isset($_GET['from'])?$_GET['from']:14;

        $tpl=isset($_GET['tpl'])?$_GET['tpl']:'activity';

        $this->assign('script',$from);
        //量尺分类
        $goodscat = M('goodstype')->select();
        $this->assign('goodscat',$goodscat);
        //预约人数
        $toDay=strtotime(date('Y-m-d'));
        $where = "type=3";
        $MC=M('guestbook')->where($where)->count();

        $this->assign('MC',$MC?$MC:$this->site_info['pnum']);

        $this->assign("title", "315开门红");

        $this->display(':'.$tpl);
    }




}
?>