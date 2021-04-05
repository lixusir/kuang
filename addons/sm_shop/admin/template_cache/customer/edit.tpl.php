<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH)?>

<style>

    img.avatar{

        width:100px;
        border-radius: 10px;
    }

</style>
<div id="container">
    <?php include $this->template('common/nav', TEMPLATE_INCLUDEPATH)?>

    <div id="content" >

        <div class="page-header">
            <div class="container-fluid">
                <div class="pull-right">
                    <button  class="btn btn-primary"
                             v-on:click="save()"
                             data-original-title="保存">
                        <i class="fa fa-save"></i>
                    </button>
                    <!--<button type="button" id="save-variant" title="" class="btn btn-success" >
                        <i class="fa fa-save"></i>
                    </button>-->
                    <a v-bind:href="url_pre + '&r=customer.page_list'" title=""
                       class="btn btn-default" >
                        <i class="fa fa-reply"></i>
                    </a>
                </div>
                <h1>客户管理</h1>
                <ul class="breadcrumb">
                    <li>首页</li>
                    <li>客户管理</li>
                </ul>
            </div>
        </div>
        <div class="container-fluid">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> 客户管理</h3>
                </div>

                <div class="panel-body">

                    <div class="form-horizontal">

                        <div class="tab-content">

                            <div class="tab-pane active" >

                                <div class="form-group required">
                                    <label class="col-md-2 control-label" for="input-avatar">
                                        头像
                                    </label>
                                    <div class="col-md-10">
                                        <img class='avatar' v-bind:src="customer.headUrl" />
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label class="col-md-2 control-label" for="input-name2">
                                        昵称
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" disabled v-model="customer.name" value=""
                                               placeholder="昵称"
                                               id="input-name" class="form-control">
<!--                                        {{customer.name}}-->
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label class="col-md-2 control-label" for="input-name2">
                                        手机号码
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" disabled v-model="customer.telephone" value=""
                                               placeholder="手机号码"
                                               id="input-telephone" class="form-control">

<!--                                        {{customer.telephone}}-->
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label class="col-md-2 control-label" for="input-name2">
                                        注册日期
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" disabled v-model="customer.create_time" value=""
                                               placeholder="注册日期"
                                               id="input-create_time" class="form-control">

                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label class="col-md-2 control-label" for="textarea-remark">
                                        备注
                                    </label>
                                    <div class="col-md-10">
                                        <textarea v-model="customer.remark"
                                                  id="textarea-remark" class="form-control">

                                        </textarea>

                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label class="col-md-2 control-label" for="input-group">
                                        群组
                                    </label>
                                    <div class="col-md-10">
                                        <select v-model="customer.customer_group_id"
                                               placeholder="注册日期"
                                               id="input-group" class="form-control">
                                            <option v-for="item in customer_groups"
                                                    v-bind:value="item.id">
                                                {{item.name}}
                                            </option>
                                        </select>

                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<script>

    var vue = new Vue({
        el: '#container',
        name: "customer",

        data:function () {

            return{

                customer_id:0,
                customer:{
                    customer_group_id:'',
                    remark:'',
                },
                customer_groups: [],

                url_pre:'<?php echo $this->url_pre;?>',
            }

        },

        methods:{

            get_customer:function(){

                var t = this;
                var url = this.url_pre + '&r=customer.single';

                url += '&id=' + this.customer_id;

                axios.get( url ).then(function( res ){

                    t.customer = res.data;

                });

            },

            save:function(){

                var t = this;
                var url = this.url_pre + '&r=customer.edit';

                url += '&id=' + this.customer_id;

                var data = 'customer_group_id=' + this.customer.customer_group_id;
                data += '&remark=' + this.customer.remark;

                axios.post( url, data ).then(function( res ){

                    if( res.data.status==0 ){
                        location.href = t.url_pre + '&r=customer.page_list';
                    }else if(res.data.description ){
                        alert( res.data.description )
                    }

                });

            },

            get_customer_group:function( ){

                var t = this;
                var url = this.url_pre + '&r=customerGroup.index';

                axios.get( url ).then(function( res ){

                    t.customer_groups = res.data;

                });

            }

        },

        created:function(){

            this.customer_id = getQueryString( 'id' );
            this.get_customer();
            this.get_customer_group();

        }

    });
</script>