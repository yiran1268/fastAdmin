<?php

namespace app\admin\controller\image;

use app\common\controller\Backend;

/**
 * 会员管理
 *
 * @icon fa fa-user
 */
class Image extends Backend
{

    protected $relationSearch = true;


    /**
     * @var \app\admin\model\User
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('Image');
    }

    /**
     * 查看
     */
    public function index()
    {
        $offset = $this->request->get("offset", 0);
        $limit = $this->request->get("limit", 0);

        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            $total = $this->model->count();

            $list = $this->model->order('id desc')->limit($offset, $limit)->select();

            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    /**
     * 编辑
     */
    public function edit($ids = NULL)
    {
        $row = $this->model->get($ids);
        if (!$row)
            $this->error(__('No Results were found'));
        $arrCate = array(
                    1 => '分组一',
                    2 => '分组二',
                    3 => '分组三',
                );
        $this->view->assign('groupList', build_select('row[cid]', $arrCate, $row['cid'], ['class' => 'form-control selectpicker']));
        return parent::edit($ids);
    }

    public function add()
    {
        $arrCate = array(
                    1 => '分组一',
                    2 => '分组二',
                    3 => '分组三',
                );
        $this->view->assign('groupList', build_select('row[cid]', $arrCate, '', ['class' => 'form-control selectpicker']));
        return parent::add();
    }

}
