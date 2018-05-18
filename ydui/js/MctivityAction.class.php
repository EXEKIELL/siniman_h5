<?php

class MctivityAction extends Action{

    public function __construct()
    {
        parent::__construct();
        $this->assign('path', 'http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/index.php');
        $this->assign('top_path', 'http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/topics.php');
        $this->assign('imgLink', 'http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/Topics/Tpl/');
    }
    function index(){
        $from=isset($_GET['from'])?$_GET['from']:14;

        $tpl=isset($_GET['tpl'])?$_GET['tpl']:'subject';

        $this->assign('script',$from);
        //量尺分类
        $goodscat = M('goodstype')->select();
        $this->assign('goodscat',$goodscat);

        $this->region = $this->get_region();

        $this->assign("title", "315开门红");

        $this->display(':'.$tpl);
    }

    //省市区
    public function get_region(){
        if(is_file('region.json')){
            $region= file_get_contents('region.json');
            return $region;
        }else{
            $list = M('region')->where('parent_id=1')->select();
            foreach($list as $k=>$v){
                $list[$k]['city'] = M('region')->where('parent_id='.$v['region_id'])->select();
                foreach($list[$k]['city'] as $key=>$val){
                    $list[$k]['city'][$key]['area'] = M('region')->where('parent_id='.$val['region_id'])->select();
                }
            }
            $region = json_encode($list);
            file_put_contents('region.json',$region);
        }
        echo $region;
    }
    

}
?>