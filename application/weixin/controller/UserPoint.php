<?php
namespace app\weixin\controller;
use think\Db;
use think\Request;
use app\common\lib\ReturnData;
use app\common\lib\Helper;

class UserPoint extends Base
{
    public function _initialize()
	{
		parent::_initialize();
    }
    
    //列表
    public function index()
	{
		//参数
		$pagesize = 10;
        $offset = 0;
        if(isset($_REQUEST['page'])){$offset = ($_REQUEST['page']-1)*$pagesize;}
        //获取积分明细列表
        $get_data = array(
            'limit'  => $pagesize,
            'offset' => $offset,
            'access_token' => $this->login_info['token']['token']
		);
        $url = get_api_url_address().'/user_point/index';
		$res = Util::curl_request($url,$get_data,'GET');
        $assign_data['list'] = $res['data']['list'];
        //总页数
        $assign_data['totalpage'] = ceil($res['data']['count']/$pagesize);
        
        if(isset($_REQUEST['page_ajax']) && $_REQUEST['page_ajax']==1)
        {
    		$html = '';
            
            if($res['data']['list'])
            {
                foreach($res['data']['list'] as $k => $v)
                {
                    $html .= '<li>';
                    if($v['type']==0)
                    {
                        $html .= '<span class="green">+ '.$v['point'].'</span>';
                    }
                    else
                    {
                        $html .= '<span>- '.$v['point'].'</span>';
                    }
                    $html .= '<div class="info"><p class="tit">'.$v['desc'].'</p>';
                    $html .= '<p class="time">'.date('Y-m-d H:i:s',$v['add_time']).'</p></div>';
                    $html .= '</li>';
                }
            }
            
    		exit(json_encode($html));
    	}
		
		$this->assign($assign_data);
        return $this->fetch();
    }
}