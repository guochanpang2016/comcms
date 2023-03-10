<?php

namespace app\common\validate;

use think\Validate;

class ArticleType extends Validate
{
    // 验证规则
    protected $rule = [
        ['id', 'require|number|gt:0', 'ID不能为空|ID必须是数字|ID格式不正确'],
        ['parent_id', 'number|egt:0', '父级ID必须是数字|父级ID格式不正确'],
        ['name', 'require|max:30', '栏目名称不能为空|栏目名称不能超过30个字符'],
        ['seotitle', 'max:150', 'seo标题不能超过150个字符'],
        ['keywords', 'max:60', '关键词不能超过60个字符'],
        ['description', 'max:250', '描述不能超过250个字符'],
        ['filename', 'require|max:30|regex:/^[a-z]{1,}[a-z0-9]*$/', '别名不能为空|别名不能超过30个字符|别名格式不正确'],
        ['templist', 'max:50|regex:/^[a-z]{1,}[a-z0-9]*$/', '列表页模板不能超过50个字符|列表页模板格式不正确'],
        ['temparticle', 'max:50|regex:/^[a-z]{1,}[a-z0-9]*$/', '文章页模板不能超过50个字符|文章页模板格式不正确'],
        ['litpic', 'max:150', '缩略图不能超过150个字符'],
        ['is_part', 'in:0,1,2', '栏目属性：0列表栏目（允许发布文档），1频道封面（不允许发布文档）'],
        ['listorder', 'number|egt:0', '排序必须是数字|排序格式不正确'],
        ['shop_id', 'number|egt:0', '店铺ID必须是数字|店铺ID格式不正确'],
        ['add_time', 'require|number|egt:0', '添加时间不能为空|添加时间格式不正确|添加时间格式不正确'],
        ['update_time', 'require|number|egt:0', '更新时间不能为空|更新时间格式不正确|更新时间格式不正确'],
    ];

    protected $scene = [
        'add' => ['parent_id', 'name', 'seotitle', 'keywords', 'description', 'filename', 'templist', 'temparticle', 'litpic', 'is_part', 'listorder', 'shop_id', 'add_time', 'update_time'],
        'edit' => ['parent_id', 'name', 'seotitle', 'keywords', 'description', 'filename', 'templist', 'temparticle', 'litpic', 'is_part', 'listorder', 'shop_id', 'update_time'],
        'del' => ['id'],
    ];
}