<?php

namespace app\common\validate;

use think\Validate;

class Page extends Validate
{
    // 验证规则
    protected $rule = [
        ['id', 'require|number|gt:0', 'ID不能为空|ID必须是数字|ID格式不正确'],
        ['title', 'require|max:150', '标题不能为空|标题不能超过150个字符'],
        ['seotitle', 'max:150', 'seo标题不能超过150个字符'],
        ['keywords', 'max:60', '关键词不能超过60个字符'],
        ['description', 'max:250', '描述不能超过60个字符'],
        ['template', 'max:30', '模板名称不能超过30个字符'],
        ['filename', 'require|max:60|regex:/^[a-z]{1,}[a-z0-9]*$/', '别名不能为空|别名不能超过60个字符|别名格式不正确'],
        ['litpic', 'max:150', '缩略图不能超过150个字符'],
        ['click', 'number|egt:0', '点击量必须是数字|点击量格式不正确'],
        ['group_id', 'number|egt:0', '分组ID必须是数字|分组ID格式不正确'],
        ['add_time', 'require|number|egt:0', '添加时间不能为空|添加时间格式不正确|添加时间格式不正确'],
        ['update_time', 'require|number|egt:0', '更新时间不能为空|更新时间格式不正确|更新时间格式不正确'],
    ];

    protected $scene = [
        'add' => ['title', 'seotitle', 'keywords', 'description', 'template', 'filename', 'litpic', 'click', 'group_id', 'add_time', 'update_time'],
        'edit' => ['title', 'seotitle', 'keywords', 'description', 'template', 'filename', 'litpic', 'click', 'group_id', 'update_time'],
        'del' => ['id'],
    ];
}