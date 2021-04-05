<?php

//20200612
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Page extends WeModuleSite
{
    public function runTasks()
    {
        global $_W;
        load()->func('communication');
        $lasttime = strtotime(m('cache')->getString('receive', 'global'));
        $interval = m('common')->getSysset('task')['receive_time'];
        if (empty($interval)) {
            $interval = 60;
        }
        $interval *= 60;
        
        //如果上次收货时间小
        $current = time();
        
        if ($lasttime + $interval <= $current) {
            m('cache')->set('receive', date('Y-m-d H:i:s', $current), 'global');
            (ihttp_request(EWEI_SHOPV2_TASK_URL . "order/receive.php", null, null, 10));
        }
        
        //自动关闭订单
        $lasttime = strtotime(m('cache')->getString('closeorder', 'global'));
        $interval = m('common')->getSysset('task')['closeorder_time'];
        if (empty($interval)) {
            $interval = 60;
        }
        $interval *= 60;
        //如果上次自动关闭时间小
        $current = time();
        if ($lasttime + $interval <= $current) {
            m('cache')->set('closeorder', date('Y-m-d H:i:s', $current), 'global');
            ihttp_request(EWEI_SHOPV2_TASK_URL . "order/close.php", null, null, 10);
        }
        
        //自动关闭虚拟卡密订单
        $lasttime = strtotime(m('cache')->getString('closeorder_virtual', 'global'));
        $interval_v = intval(m('cache')->getString('closeorder_virtual_time', 'global'));
        if (empty($interval_v)) {
            $interval_v = 60;
        }
        //如果上次自动关闭时间小
        $current = time();
        if ($lasttime + $interval_v <= $current) {
            m('cache')->set('closeorder_virtual', date('Y-m-d H:i:s', $current), 'global');
            ihttp_request(EWEI_SHOPV2_TASK_URL . "order/close.php", array('uniacid'=>$_W['uniacid']), null, 10);
        }
        
        //自动商品全返
        $lasttime = strtotime(m('cache')->getString('fullback_receive', 'global'));
        $interval = m('common')->getSysset('task')['fullback_receive_time'];
        if (empty($interval)) {
            $interval = 60;
        }
        $interval *= 60;
        //如果上次自动关闭时间小
        $current = time();
        if ($lasttime + $interval <= $current) {
            m('cache')->set('fullback_receive', date('Y-m-d H:i:s', $current), 'global');
            ihttp_request(EWEI_SHOPV2_TASK_URL . "order/fullback.php", null, null, 10);
        }
        /*
         * 预售商品到期自动下架
         * */
        $lasttime = strtotime(m('cache')->getString('presell_status', 'global'));
        $interval = m('common')->getSysset('task')['presell_status_time'];
        if (empty($interval)) {
            $interval = 60;
        }
        $interval *= 60;
        //如果上次自动关闭时间小
        $current = time();
        if ($lasttime + $interval <= $current) {
            m('cache')->set('presell_status', date('Y-m-d H:i:s', $current), 'global');
            ihttp_request(EWEI_SHOPV2_TASK_URL . "goods/presell.php", null, null, 10);
        }
        
        /*
         * 商品自动上下架
         * */
        $lasttime = strtotime(m('cache')->getString('status_receive', 'global'));
        $interval = m('common')->getSysset('task')['status_receive_time'];
        if (empty($interval)) {
            $interval = 60;
        }
        $interval *= 60;
        //如果上次自动关闭时间小
        $current = time();
        if ($lasttime + $interval <= $current) {
            m('cache')->set('status_receive', date('Y-m-d H:i:s', $current), 'global');
            ihttp_request(EWEI_SHOPV2_TASK_URL . "goods/status.php", null, null, 10);
        }
        
        //即将关闭订单
        if (com('coupon')) {
            $lasttime = strtotime(m('cache')->getString('willcloseorder', 'global'));
            $interval = m('common')->getSysset('task')['willcloseorder_time'];
            if (empty($interval)) {
                $interval = 20;  //20
            }
            
            $interval *= 60;//60
            //如果上次执行时间小
            $current = time();
            if ($lasttime + $interval <= $current) {
                
                m('cache')->set('willcloseorder', date('Y-m-d H:i:s', $current), 'global');
                //require_once EWEI_SHOPV2_PATH.'core/task/order/willclose.php';
                ihttp_request(EWEI_SHOPV2_TASK_URL . "order/willclose.php", null, null, 10);
            }
        }
        
        //优惠券自动返利
        if (com('coupon')) {
            $lasttime = strtotime(m('cache')->getString('couponback', 'global'));
            $interval = m('common')->getSysset('task')['couponback_time'];
            if (empty($interval)) {
                $interval = 60;
            }
            $interval *= 60;
            //如果上次执行时间小
            $current = time();
            if ($lasttime + $interval <= $current) {
                m('cache')->set('couponback', date('Y-m-d H:i:s', $current), 'global');
                ihttp_request(EWEI_SHOPV2_TASK_URL . "coupon/back.php", null, null, 10);
            }
        }
        
        //自动发送卖家通知
        $lasttime = strtotime(m('cache')->getString('sendnotice', 'global'));
        $interval = intval(m('cache')->getString('sendnotice_time', 'global'));
        if (empty($interval)) {
            $interval = 60;
        }
        $interval *= 60;
        //如果上次自动关闭时间小
        $current = time();
        if ($lasttime + $interval <= $current) {
            m('cache')->set('sendnotice', date('Y-m-d H:i:s', $current), 'global');
            ihttp_request(EWEI_SHOPV2_TASK_URL . "notice/sendnotice.php", array('uniacid' => $_W['uniacid']), null, 10);
        }
        
        //自动发送周期购卖家发货通知
        $lasttime = strtotime(m('cache')->getString('sendcycelbuy', 'global'));
        $interval = intval(m('cache')->getString('sendcycelbuy_time', 'global'));
        if (empty($interval)) {
            $interval = 60;
        }
        $interval *= 60;
        //如果上次自动关闭时间小
        $current = time();
        if ($lasttime + $interval <= $current) {
            m('cache')->set('sendcycelbuy', date('Y-m-d H:i:s', $current), 'global');
            ihttp_request(EWEI_SHOPV2_TASK_URL . "cycelbuy/sendnotice.php", array('uniacid' => $_W['uniacid']), null, 10);
        }
        
        //周期购每期自动收货
        $lasttime = strtotime(m('cache')->getString('cycelbuyreceive', 'global'));
        $interval = intval(m('cache')->getString('cycelbuyreceive_time', 'global'));
        if (empty($interval)) {
            $interval = 60;
        }
        $interval *= 60;
        //如果上次自动关闭时间小
        $current = time();
        if ($lasttime + $interval <= $current) {
            m('cache')->set('cycelbuyreceive', date('Y-m-d H:i:s', $current), 'global');
            ihttp_request(EWEI_SHOPV2_TASK_URL . "cycelbuy/receive.php", array('uniacid' => $_W['uniacid']), null, 10);
        }
        
        if (p('groups')) {
            /*
             * 拼团未付款订单自动取消
             * */
            $groups_order_lasttime = strtotime(m('cache')->getString('groups_order_cancelorder', 'global'));
            $groups_order_interval = m('common')->getSysset('task')['groups_order_cancelorder_time'];
            if (empty($groups_order_interval)) {
                $groups_order_interval = 60;
            }
            
            $groups_order_interval *= 60;
            //如果上次自动关闭时间小
            $groups_order_current = time();
            if ($groups_order_lasttime + $groups_order_interval <= $groups_order_current) {
                m('cache')->set('groups_order_cancelorder', date('Y-m-d H:i:s', $groups_order_current), 'global');
                ihttp_request($_W['siteroot'] . "addons/ewei_shopv2/plugin/groups/task/order.php", null, null, 10);
            }
            /*
             * 拼团失败自动退款
             * */
            $groups_team_lasttime = strtotime(m('cache')->getString('groups_team_refund', 'global'));
            $groups_team_interval = m('common')->getSysset('task')['groups_team_refund_time'];
            if (empty($groups_team_interval)) {
                $groups_team_interval = 60;
            }
            
            $groups_team_interval *= 60;
            //如果上次自动关闭时间小
            $groups_team_current = time();
            if ($groups_team_lasttime + $groups_team_interval <= $groups_team_current) {
                m('cache')->set('groups_team_refund', date('Y-m-d H:i:s', $groups_team_current), 'global');
                ihttp_request($_W['siteroot'] . "addons/ewei_shopv2/plugin/groups/task/refund.php?uniacid={$_W['uniacid']}", null, null, 10);
            }
            /*
             * 拼团发货自动收货
             * */
            $groups_receive_lasttime = strtotime(m('cache')->getString('groups_receive', 'global'));
            $groups_receive_interval = m('common')->getSysset('task')['groups_receive_time'];
            if (empty($groups_receive_interval)) {
                $groups_receive_interval = 60;
            }
            
            $groups_receive_interval *= 60;
            //如果上次自动关闭时间小
            $groups_receive_current = time();
            if ($groups_receive_lasttime + $groups_receive_interval <= $groups_receive_current) {
                m('cache')->set('groups_receive', date('Y-m-d H:i:s', $groups_receive_current), 'global');
                ihttp_request($_W['siteroot'] . "addons/ewei_shopv2/plugin/groups/task/receive.php", null, null, 10);
            }
        }
        
        if (p('seckill')) {
            $lasttime = strtotime(m('cache')->getString('seckill_delete_lasttime', 'global'));
            $interval = 5 * 60;
            //如果上次执行时间小
            $current = time();
            if ($lasttime + $interval <= $current) {
                m('cache')->set('seckill_delete_lasttime', date('Y-m-d H:i:s', $current), 'global');
                ihttp_request($_W['siteroot'] . "addons/ewei_shopv2/plugin/seckill/task/delete.php", null, null, 10);
            }
        }
        //卡密延迟60秒发送
//        ihttp_request($url=EWEI_SHOPV2_TASK_URL . "order/virtualsend.php", array('uniacid'=>$_W['uniacid'],'acid'=>$_W['acid']),null,1);
//        exit('run finished.');
        
        /**
         * 发送瓜分券失败通知
         */
        if (p('friendcoupon')) {
            $lasttime = strtotime(m('cache')->getString('friendcoupon_send_failed_message', 'global'));
            $interval = 60;
            $current = time();
            if ($lasttime + $interval <= $current) {
                m('cache')->set('friendcoupon_send_failed_message', date('Y-m-d H:i:s', $current), 'global');
                ihttp_request($_W['siteroot'] . "addons/ewei_shopv2/plugin/friendcoupon/task/sendMessage.php?uniacid={$_W['uniacid']}", null, null, 10);
            }
        }
        
        //多商户到期自动下架商品
        if (p('merch')) {
            $lasttime = strtotime(m('cache')->getString('merch_expire', 'global'));
            $interval = 5 * 60;
            //如果上次自动关闭时间小
            $current = time();
            if ($lasttime + $interval <= $current) {
                m('cache')->set('merch_expire', date('Y-m-d H:i:s', $current), 'global');
                ihttp_request(EWEI_SHOPV2_TASK_URL . "plugin/merch.php", null, null, 10);
            }
        }

        /** 检测核销订单是否快超过时间
         * TODO
         */

        $lasttime = strtotime(m('cache')->getString('willcloseverifyorder', 'global'));
        $interval = m('common')->getSysset('task')['willcloseverifyorder_time'];
        if (empty($interval)) {
            $interval = 20;  //20
        }

        $interval *= 60;//60
        //如果上次执行时间小
        $current = time();
        if ($lasttime + $interval <= $current) {

            m('cache')->set('willcloseverifyorder', date('Y-m-d H:i:s', $current), 'global');
            //require_once EWEI_SHOPV2_PATH.'core/task/order/willclose.php';
            ihttp_request(EWEI_SHOPV2_TASK_URL . "order/willcloseverify.php", null, null, 10);
        }


    }
    
    public function template($filename = '', $type = TEMPLATE_INCLUDEPATH, $account = false){
        global $_W, $_GPC;
        
        // 判断是否V3
        // $set = m('common')->getSysset('template');
        $isv3 = true;
        
        if(isset($_W['shopversion'])){
            $isv3 = $_W['shopversion'];
        }
        
        if($isv3 && !empty($_GPC['v2'])){
            $isv3 = false;
        }
        
        if(!empty($_W['plugin']) && $isv3){
            $plugin_config = m('plugin')->getConfig($_W['plugin']);
            if((is_array($plugin_config) && empty($plugin_config['v3'])) || !$plugin_config){
                $isv3 = false;
            }
        }
        
        $bsaeTemp = array('_header', '_header_base', '_footer', '_tabs', 'funbar');
        if($_W['plugin']=='merch' && $_W['merch_user'] && (!in_array($filename, $bsaeTemp) || !$isv3)){
            return $this->template_merch($filename, $isv3);
        }
        
        // 主商城模板处理
        if (empty($filename)) {
            $filename = str_replace(".", "/", $_W['routes']);
        }
        if ( $_GPC['do'] == 'web' || defined('IN_SYS')) {
            $filename = str_replace("/add", "/post", $filename);
            $filename = str_replace("/edit", "/post", $filename);
            $filename_default = str_replace("/add", "/post", $filename);
            $filename_default = str_replace("/edit", "/post", $filename_default);
            $filename = 'web/' . $filename_default;
            $filename_v3 = 'web_v3/' . $filename_default;
        }
        
        $name = 'ewei_shopv2';
        $moduleroot = IA_ROOT . "/addons/ewei_shopv2";
        
        // 管理端
        if (defined('IN_SYS')) {
            if(!$isv3){
                $compile = IA_ROOT . "/data/tpl/web/{$_W['template']}/{$name}/{$filename}.tpl.php";
                $source = $moduleroot . "/template/{$filename}.html";
                if (!is_file($source)) {
                    $source = $moduleroot . "/template/{$filename}/index.html";
                }
            }
            if($isv3 || !is_file($source)){
                if($isv3){
                    $compile = IA_ROOT . "/data/tpl/web_v3/{$_W['template']}/{$name}/{$filename}.tpl.php";
                }
                $source = $moduleroot . "/template/{$filename_v3}.html";
                if (!is_file($source)) {
                    $source = $moduleroot . "/template/{$filename_v3}/index.html";
                }
            }
            if (!is_file($source)) {
                $explode = array_slice(explode('/', $filename), 1);
                $temp = array_slice($explode, 1);
                if($isv3){
                    $source = $moduleroot . "/plugin/" . $explode[0] . "/template/web_v3/" . implode('/', $temp) . ".html";
                    if (!is_file($source)) {
                        $source = $moduleroot . "/plugin/" . $explode[0] . "/template/web_v3/" . implode('/', $temp) . "/index.html";
                    }
                }
                if(!$isv3 || !is_file($source)){
                    $source = $moduleroot . "/plugin/" . $explode[0] . "/template/web/" . implode('/', $temp) . ".html";
                    if (!is_file($source)) {
                        $source = $moduleroot . "/plugin/" . $explode[0] . "/template/web/" . implode('/', $temp) . "/index.html";
                    }
                }
            }
        }
        // account页面
        elseif ($account){
            $template = $_W['shopset']['wap']['style'];
            if (empty($template)) {
                $template = "default";
            }
            if (!is_dir($moduleroot . "/template/account/" . $template)) {
                $template = "default";
            }
            $compile = IA_ROOT . "/data/tpl/app/{$name}/{$template}/account/{$filename}.tpl.php";
            $source = IA_ROOT . "/addons/{$name}/template/account/{$template}/{$filename}.html";
            if (!is_file($source)) {
                $source = IA_ROOT . "/addons/{$name}/template/account/default/{$filename}.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/addons/{$name}/template/account/default/{$filename}/index.html";
            }
        }
        // 手机端商城页面
        else{
            $template = m('cache')->getString('template_shop');
            if (empty($template)) {
                $template = "default";
            }
            if (!is_dir($moduleroot . "/template/mobile/" . $template)) {
                $template = "default";
            }
            $compile = IA_ROOT . "/data/tpl/app/{$name}/{$template}/mobile/{$filename}.tpl.php";
            $source = IA_ROOT . "/addons/{$name}/template/mobile/{$template}/{$filename}.html";
            if (!is_file($source)) {
                $source = IA_ROOT . "/addons/{$name}/template/mobile/{$template}/{$filename}/index.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/addons/{$name}/template/mobile/default/{$filename}.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/addons/{$name}/template/mobile/default/{$filename}/index.html";
            }
            
            // 插件页面
            if (!is_file($source)) {
                //如果还没有就是插件的
                $names = explode('/', $filename);
                $pluginname = $names[0];
                $ptemplate = m('cache')->getString('template_' . $pluginname);
                if (empty($ptemplate) || $pluginname == 'creditshop') {
                    $ptemplate = "default";
                }
                if (!is_dir($moduleroot . "/plugin/" . $pluginname . "/template/mobile/" . $ptemplate)) {
                    $ptemplate = "default";
                }
                unset($names[0]);
                $pfilename = implode('/', $names);
                $compile = IA_ROOT . "/data/tpl/app/{$name}/plugin/{$pluginname}/{$ptemplate}/mobile/{$filename}.tpl.php";
                $source = $moduleroot . "/plugin/" . $pluginname . "/template/mobile/" . $ptemplate . "/{$pfilename}.html";
                if (!is_file($source)) {
                    $source = $moduleroot . "/plugin/" . $pluginname . "/template/mobile/" . $ptemplate . "/" . $pfilename . "/index.html";
                }
                if (!is_file($source)) {
                    $source = $moduleroot . "/plugin/" . $pluginname . "/template/mobile/default/{$pfilename}.html";
                }
                if (!is_file($source)) {
                    $source = $moduleroot . "/plugin/" . $pluginname . "/template/mobile/default/" . $pfilename . "/index.html";
                }
            }
        }
        
        if (!is_file($source)) {
            exit("Error: template source '{$filename}' is not exist!");
        }
        if (DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile)) {
            shop_template_compile($source, $compile, true);
        }
        
        return $compile;
    }
    
    public function template_merch($filename, $isv3) {
        global $_W;
        
        if (empty($filename)) {
            $filename = str_replace(".", "/", $_W['routes']);
        }
        
        $filename = str_replace("/add", "/post", $filename);
        $filename = str_replace("/edit", "/post", $filename);
        
        $name = 'ewei_shopv2';
        $moduleroot = IA_ROOT . "/addons/ewei_shopv2";
        
        $compile = IA_ROOT . "/data/tpl/web/{$_W['template']}/merch/{$name}/{$filename}.tpl.php";
        $explode = explode('/', $filename);
        if($isv3){
            $source = $moduleroot . "/plugin/merch/template/web_v3/manage/" . implode('/', $explode) . ".html";
            if (!is_file($source)) {
                $source = $moduleroot . "/plugin/merch/template/web_v3/manage/" . implode('/', $explode) . "/index.html";
            }
        }
        if(!$isv3 || !is_file($source)){
            $source = $moduleroot . "/plugin/merch/template/web/manage/" . implode('/', $explode) . ".html";
            if (!is_file($source)) {
                $source = $moduleroot . "/plugin/merch/template/web/manage/" . implode('/', $explode) . "/index.html";
            }
        }
        
        //别的插件
        if (!is_file($source)) {
            $explode = explode('/', $filename);
            $temp = array_slice($explode, 1);
            if($isv3){
                $source = $moduleroot . "/plugin/" . $explode[0] . "/template/web_v3/" . implode('/', $temp) . ".html";
                if (!is_file($source)) {
                    $source = $moduleroot . "/plugin/" . $explode[0] . "/template/web_v3/" . implode('/', $temp) . "/index.html";
                }
            }
            if(!$isv3 || !is_file($source)){
                $source = $moduleroot . "/plugin/" . $explode[0] . "/template/web/" . implode('/', $temp) . ".html";
                if (!is_file($source)) {
                    $source = $moduleroot . "/plugin/" . $explode[0] . "/template/web/" . implode('/', $temp) . "/index.html";
                }
            }
        }
        
        if (!is_file($source)) {
            exit("Error: template source '{$filename}' is not exist!");
        }
        
        if (DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile)) {
            shop_template_compile($source, $compile, true);
        }
        return $compile;
    }
    
    function message($msg, $redirect = '', $type = '')
    {
        global $_W;
        $title = "";
        $buttontext = "";
        $message = $msg;
        $buttondisplay = true;
        if (is_array($msg)) {
            $message = isset($msg['message']) ? $msg['message'] : '';
            $title = isset($msg['title']) ? $msg['title'] : '';
            $buttontext = isset($msg['buttontext']) ? $msg['buttontext'] : '';
            $buttondisplay = isset($msg['buttondisplay']) ? $msg['buttondisplay'] : true;
        }
        if (empty($redirect)) {
            $redirect = 'javascript:history.back(-1);';
        } elseif ($redirect == 'close') {
            $redirect = 'javascript:WeixinJSBridge.call("closeWindow")';
        } elseif ($redirect == 'exit') {
            $redirect = "";
        }
        
        include $this->template('_message');
        exit;
    }
    
    function checkSubmit($key, $time = 2, $message = '操作频繁，请稍后再试!')
    {
        
        global $_W;
        $open_redis = function_exists('redis') && !is_error(redis());
        if ($open_redis) {
            $redis_key = "{$_W['setting']['site']['key']}_{$_W['account']['key']}_{$_W['uniacid']}_{$_W['openid']}_mobilesubmit_{$key}";
            $redis = redis();
            if ($redis->setnx($redis_key, time())) {
                $redis->expireAt($redis_key, time() + $time);
            } else {
                return error(-1, $message);
            }
        }
        return true;
        
    }
    function checkSubmitGlobal($key, $time = 2, $message = '操作频繁，请稍后再试!')
    {
        
        global $_W;
        $open_redis = function_exists('redis') && !is_error(redis());
        if ($open_redis) {
            $redis_key = "{$_W['setting']['site']['key']}_{$_W['account']['key']}_{$_W['uniacid']}_mobilesubmit_{$key}";
            $redis = redis();
            if ($redis->setnx($redis_key, time())) {
                $redis->expireAt($redis_key, time() + $time);
            } else {
                return error(-1, $message);
            }
        }
        return true;
        
    }
    
    
    
}