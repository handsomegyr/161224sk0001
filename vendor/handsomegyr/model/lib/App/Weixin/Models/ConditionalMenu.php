<?php
namespace App\Weixin\Models;

class ConditionalMenu extends \App\Common\Models\Weixin\ConditionalMenu
{

    /**
     * 获取匹配规则的列表信息
     *
     * @return array
     */
    public function getList4MatchRule()
    {
        return $this->findAll(array(
            'matchrule' => array(
                '$ne' => ''
            )
        ), array(
            'priority' => - 1
        ));
    }

    /**
     * 构建菜单
     *
     * @return array
     */
    public function buildMenusWithMatchrule(array $matchRule)
    {
        $matchRuleParent = myMongoId($matchRule['_id']);
        $ruleInfo = array();
        foreach (array(
            "group_id",
            "sex",
            "country",
            "province",
            "city",
            "client_platform_type",
            "language"
        ) as $field) {
            $ruleInfo[$field] = empty($matchRule['ruleInfo'][$field]) ? '' : $matchRule['ruleInfo'][$field];
        }
        $plainText = implode('', $ruleInfo);
        if (empty($plainText)) {
            throw new \Exception("{$matchRule['ruleInfo']['matchrule_name']}所对应的匹配规则设置不正确");
        }
        
        $menus = $this->findAll(array(
            'parent' => $matchRuleParent
        ), array(
            'priority' => - 1
        ));
        $parentList = array(
            $matchRuleParent
        );
        if (! empty($menus)) {
            foreach ($menus as $item) {
                $parentList[] = $item['_id'];
            }
        }
        
        $menus = $this->findAll(array(
            'parent' => array(
                '$in' => $parentList
            )
        ), array(
            'priority' => - 1
        ), array(
            '_id' => true,
            'parent' => true,
            'type' => true,
            'name' => true,
            'key' => true,
            'url' => true
        ));
        if (! empty($menus)) {
            $menus = convertToPureArray($menus);
            $parent = array();
            $new = array();
            foreach ($menus as $a) {
				unset($a['matchrule']);
				unset($a['menuid']);
				unset($a['menu_time']);
				unset($a['__CREATE_TIME__']);
				unset($a['__MODIFY_TIME__']);
				unset($a['__REMOVED__']);
                if ($a['parent'] == $matchRuleParent)
                    $parent[] = $a;
                $new[$a['parent']][] = $a;
            }
            $tree = $this->buildTree($new, $parent);			
            return array(
                'button' => $tree,
                'matchrule' => $ruleInfo
            );
        } else {
            return array();
        }
    }

    public function recordMenuId(array $matchRule, $menuid)
    {
        $query = array();
        $query['_id'] = $matchRule['_id'];
        
        $data['menuid'] = $menuid;
        $data['menu_time'] = getCurrentTime();
        $this->update($query, array(
            '$set' => $data
        ));
    }

    /**
     * 循环处理菜单
     *
     * @param array $menus            
     * @param array $parent            
     * @return array
     */
    private function buildTree(&$menus, $parent)
    {
        $tree = array();
        foreach ($parent as $k => $l) {
            $type = $l['type'];
            if (isset($menus[$l['_id']])) {
                $l['sub_button'] = $this->buildTree($menus, $menus[$l['_id']]);
                unset($l['type'], $l['key'], $l['url'], $l['_id']);
            }
            if (in_array($type, array(
                'media_id',
                'view_limited'
            ))) {
                if (isset($l['key'])) {
                    unset($l['key']);
                }
                if (isset($l['url'])) {
                    unset($l['url']);
                }
            }
            if ($type == 'view' && isset($l['key']))
                unset($l['key']);
            if (in_array($type, array(
                'click',
                'scancode_push',
                'scancode_waitmsg',
                'pic_sysphoto',
                'pic_photo_or_album',
                'pic_weixin',
                'location_select'
            )) && isset($l['url']))
                unset($l['url']);
            unset($l['parent'], $l['priority'], $l['_id']);
            $tree[] = $l;
        }
        return $tree;
    }
	
}