<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH, "sm_shop")?>
<div id="container">
    <?php include $this->template('common/nav', TEMPLATE_INCLUDEPATH, "sm_shop")?>
    <div id="content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="pull-right">
                    <button type="button" data-toggle="tooltip" title=""  class="btn btn-default hidden-md hidden-lg" data-original-title="筛选"><i class="fa fa-filter"></i></button>
                    <button  id="button-shipping"
                            form="form-order" formaction=""
                            formtarget="_blank" data-toggle="tooltip"
                            title="" class="btn btn-info hidden"
                            data-original-title="打印发货单">
                        <i class="fa fa-truck"></i></button>
                    <a  id="button-invoice"
                        class="btn btn-info"
                        v-on:click="print()"
                        title="打印订单列表">
                        <i class="fa fa-print"></i>
                    </a>

                </div>
                <h1>订单管理</h1>
                <ul class="breadcrumb">
                    <li><a href="">首页</a></li>
                    <li><a href="">订单管理</a></li>
                </ul>
            </div>
        </div>
        <div class="container-fluid">        <div class="row">
            <div id="filter-order" class="col-md-3 col-md-push-9 col-sm-12 hidden-sm hidden-xs">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-filter"></i> 筛选</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label" for="input-order-id">订单号</label>
                            <input type="text" name="filter_order_id"
                                   v-model="filter.order_no"
                                   placeholder="订单号"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-customer">客户</label>
                            <input type="text" name="filter_customer"
                                   v-model="filter.customer"
                                   placeholder="客户"
                                   class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="control-label"
                                   for="input-order-status">状态</label>
                            <select name="filter_order_status_id"
                                    v-model="filter.status"
                                    class="form-control">
                                <option value="">所有</option>
                                <option v-for="item in status_list"
                                        v-bind:value="item.code">
                                    {{item.name}}
                                </option>
                            </select>
                        </div>
                        <!--<div class="form-group">
                            <label class="control-label" for="input-total">总计</label>
                            <input type="text" name="filter_total" value="" placeholder="(格式: 10 或 10-20)" id="input-total" class="form-control">
                        </div>-->
                        <!----><div class="form-group">
                            <label class="control-label" for="input-date-added">订单生成日期 (开始)</label>
                            <div class="input-group date">
                                <input type="text" name="filter_date_added" value=""
                                       placeholder="订单生成日期 (开始)"
                                       data-date-format="YYYY-MM-DD"
                                       id="input-date-added" class="form-control">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-date-modified">订单生成日期 (结束)</label>
                            <div class="input-group date">
                                <input type="text" name="filter_date_modified" value=""
                                       placeholder="订单生成日期 (结束)"
                                       data-date-format="YYYY-MM-DD"
                                       id="input-date-modified" class="form-control">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <a id="button-filter"
                               v-on:click="get_list()"
                               class="btn btn-default">
                                <i class="fa fa-filter"></i> 筛选
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-md-pull-3 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-list"></i> 订单列表</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" enctype="multipart/form-data" id="form-order">
                            <div class="table-responsive">
                                <table id="order-list" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <td style="width: 1px;" class="text-center">
                                            <input type="checkbox" onclick="$('input[name*=\'selected\']').trigger('click');"></td>
                                        <td class="text-left">
                                            <a  class="desc">订单号</a> </td>
                                        <td class="text-right">
                                            <a >客户名称</a> </td>
                                        <td class="text-right">
                                            <a >状态</a> </td>
                                        <td class="text-right">
                                            <a >支付</a> </td>
                                        <td class="text-left">
                                            <a >总计</a> </td>
                                        <td class="text-right">
                                            <a >生成日期</a> </td>
                                        <!--<td class="text-left">
                                            <a >修改日期</a> </td>-->
                                        <td class="text-right">管理</td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr v-if="order_list.length>0" v-for="item in order_list">
                                        <td class="text-center">
                                            <input type="checkbox"  v-model="selected_order" name="selected[]" v-bind:value="item.id">
                                        </td>
                                        <td class="text-left">{{item.order_no}}</td>
                                        <td class="text-right">{{item.customer_name}}</td>
                                        <td class="text-right">{{item.status_text}}</td>
                                        <td class="text-right">
                                            <div v-if="item.is_payed==0">未支付</div>
                                            <div v-if="item.is_payed==1">已支付</div>
                                            <div v-if="item.is_payed==2">已退款</div>

                                            <div style="font-size: 10px;color:#f00" v-if="item.is_payed==1 && item.apply_refund">申请退款</div>
                                        </td>
                                        <td class="text-left">{{item.total}}</td>
                                        <td class="text-right">{{item.create_time}}</td>
<!--                                        <td class="text-right">{{item.create_time}}</td>-->
                                        <td class="text-right">
                                            <a v-bind:href=" config.web_url + '&r=order.page_show&order_id=' + item.id "
                                               data-toggle="tooltip" title="编辑"
                                               class="btn btn-primary" >
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </td>

                                    </tr>

                                    <tr v-if="order_list.length==0" >
                                        <td class="text-center" colspan="8">没有结果！</td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-6 text-left"></div>
                            <div class="col-sm-6 text-right">显示 0 - 0 / 合计 0（共 0 页）</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php include $this->template('common/footer', TEMPLATE_INCLUDEPATH, "sm_shop")?>

<script>
    var vue = new Vue({
        name: "order",
        el:'#container',

        data:function(){

            return {

                config:{
                    web_url:'<?php echo $this->url_pre;?>'
                },
                filter:{

                    customer:'',
                    order_no:'',
                    start_time:'',
                    end_time:'',
                    status:'',
                },
                order_list:[],
                status_list:[],

                selected_order:[]
            }
        },

        methods:{

            get_list:function(){

                var t = this;

                this.filter.start_time = $('#input-date-added').val();
                this.filter.end_time = $('#input-date-modified').val();

                var url = this.config.web_url + '&r=order.index';
                for(var p in this.filter ){
                    url += '&' + p + '=' + this.filter[p];
                }

                axios.get( url ).then(function( res ){

                    t.order_list = res.data;

                });
            },

            get_status_list:function(){

                var url = this.config.web_url + '&r=order.status_list';
                var t = this;

                axios.get( url ).then(function( res ){
                    t.status_list = res.data;

                });

            },

            print:function ( ) {

                var t = this;

                var print_list = [];
                this.order_list.forEach(function( item ){

                    if( t.selected_order.indexOf( item.id ) >= 0 ){
                        var print_item = {

                            order_no:item.order_no,
                            customer_id:item.customer_id,
                            total:item.total,
                            status_text:item.status_text,
                            create_time:item.create_time,
                        };
                        print_list.push( print_item )
                    }


                });

                console.log( print_list );
                if( print_list.length > 0 ){
                    printJS({
                        printable:print_list,
                        properties:['order_no','customer_id','total','status_text','create_time'],
                        type:'json'
                    });
                }else{

                    alert('请选择打印订单');
                }





            },

            init_datetimepicker:function(){

                $('#input-date-added,#input-date-modified').datetimepicker({
                    format:'yyyy-mm-dd',
                    startView: "year", //初始化视图是‘年’
                    minView: "month",//最精确视图为'月'
                    maxView: "decade",//最高视图为'十年'
                    language:'zh-CN'
                });

            }

        },

        created:function(){

            this.get_list();
            this.get_status_list();

            var t = this;
            setTimeout(function(){
                t.init_datetimepicker();
            });

        }

    });
</script>

<style scoped>

</style>