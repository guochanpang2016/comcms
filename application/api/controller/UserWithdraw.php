<?php
namespace app\api\controller;
use think\Db;
use think\Request;
use app\common\lib\Helper;
use app\common\lib\ReturnData;
use app\common\logic\UserWithdrawLogic;
use app\common\logic\UserWithdraw as UserWithdrawModel;

class UserWithdraw extends Base
{
	public function _initialize()
	{
		parent::_initialize();
    }
    
    public function getLogic()
    {
        return new UserWithdrawLogic();
    }
    
    //列表
    public function index()
	{
        //参数
        $where = array();
        $limit = input('limit',10);
        $offset = input('offset', 0);
        $orderby = input('orderby', 'id desc');
		if(input('method', '') !== ''){$where['method'] = input('method');}
		if(input('status', '') !== ''){$where['status'] = input('status');}
        $where['user_id'] = $this->login_info['id'];
		
        $res = $this->getLogic()->getList($where, $orderby, '*', $offset, $limit);
		
		Util::echo_json(ReturnData::create(ReturnData::SUCCESS, $res));
    }
    
    //详情
    public function detail()
	{
        //参数
        if(!checkIsNumber(input('id/d',0))){Util::echo_json(ReturnData::create(ReturnData::PARAMS_ERROR));}
        $where['id'] = input('id');
        $where['user_id'] = $this->login_info['id'];
		
		$res = $this->getLogic()->getOne($where);
        if(!$res){Util::echo_json(ReturnData::create(ReturnData::RECORD_NOT_EXIST));}
        
		Util::echo_json(ReturnData::create(ReturnData::SUCCESS, $res));
    }
    
    //添加
    public function add()
    {
        if(Helper::isPostRequest())
        {
			$_POST['user_id'] = $this->login_info['id'];
            $res = $this->getLogic()->add($_POST);
            
            Util::echo_json($res);
        }
    }
    
    //修改
    public function edit()
    {
        if(Helper::isPostRequest())
        {
            if(!checkIsNumber(input('id/d',0))){Util::echo_json(ReturnData::create(ReturnData::PARAMS_ERROR));}
            $where['id'] = input('id');
            unset($_POST['id']);
			$where['user_id'] = $this->login_info['id'];
            $res = $this->getLogic()->edit($_POST,$where);
            
            Util::echo_json($res);
        }
    }
    
    //删除
    public function del()
    {
        if(Helper::isPostRequest())
        {
            if(!checkIsNumber(input('id/d',0))){Util::echo_json(ReturnData::create(ReturnData::PARAMS_ERROR));}
            $where['id'] = input('id');
            $where['user_id'] = $this->login_info['id'];
            $res = $this->getLogic()->del($where);
            
            Util::echo_json($res);
        }
    }
}