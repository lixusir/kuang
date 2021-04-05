<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH, "sm_shop")?>
<div id="container">
    <?php include $this->template('common/nav', TEMPLATE_INCLUDEPATH, "sm_shop")?>
    <div id="content" v-on:click="clear_dropdown()">
        <div class="page-header">
            <div class="container-fluid">
                <div class="pull-right">
                    <a data-toggle="tooltip"
                       v-on:click="save()"
                       class="btn btn-primary"
                       title="保存">
                        <i class="fa fa-save"></i></a>
                    <a href="#" data-toggle="tooltip" title=""
                       class="btn btn-default" data-original-title="取消">
                        <i class="fa fa-reply"></i></a>
                </div>
                <h1>推荐商品</h1>
                <ul class="breadcrumb">
                    <li><a href="#">首页</a></li>
                    <li><a href="#">模块管理</a></li>
                    <li><a href="#">推荐商品</a></li>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> 编辑推荐模块</h3>
                </div>
                <div class="panel-body">
                    <form  method="post" enctype="multipart/form-data" id="form-module" class="form-horizontal">


                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-product">显示标题</label>
                            <div class="col-sm-10">
                                <input type="text"  v-model="recommend.title"  placeholder="标题" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-product">推荐商品</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       v-model="goods_filter"
                                       v-on:keyup="goods_search()"
                                       placeholder="推荐商品" id="input-product" class="form-control"
                                       autocomplete="off">
                                <ul class="dropdown-menu"

                                    v-bind:style="{display:search_list_show==1?'block':'none'}"
                                    style="top: 36px; left: 15px; max-height: 300px; overflow: auto;">
                                    <li v-on:click="check_goods( item )"
                                        v-for="item in search_list">
                                        <a >{{item.name}}</a>
                                    </li>


                                </ul>
                                <div id="featured-product" class="well well-sm mb-5 ui-sortable" style="height: 150px; overflow: auto;">
                                    <div v-for="item in goods_list" class="ui-sortable-handle">
                                        <i v-on:click="delete_goods( item )" class="fa fa-minus-circle"></i>
                                        {{ item.name }}

                                    </div>

                                    <!--

                                    <div id="featured-product35" class="ui-sortable-handle">
                                        <i class="fa fa-minus-circle"></i>
                                        Lorem Ipsum坐365 Officia Doloribus
                                        <input type="hidden" name="product[]" value="35">
                                    </div>

                                    <div id="featured-product33" class="ui-sortable-handle">
                                        <i class="fa fa-minus-circle"></i>
                                        HQ 66 Pro G1 14英寸轻薄笔记本电脑 i5 8G 256G SSD 2G独显
                                        <input type="hidden" name="product[]" value="33">
                                    </div>
                                    <div id="featured-product30" class="ui-sortable-handle">
                                        <i class="fa fa-minus-circle"></i>
                                        Bibo X91 全面屏双摄美颜拍照手机 6GB+128GB全网通4G手机
                                        <input type="hidden" name="product[]" value="30">
                                    </div>
                                    -->
                                </div>
                                <span class="help-block">(自动完成)</span>
                            </div>
                        </div>

                        <!--
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-width">宽</label>
                            <div class="col-sm-10">
                                <input type="text" name="width" value="300" placeholder="宽" id="input-width" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-height">高</label>
                            <div class="col-sm-10">
                                <input type="text" name="height" value="300" placeholder="高" id="input-height" class="form-control">
                            </div>
                        </div>
                        -->

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-status">状态</label>
                            <div class="col-sm-10">
                                <select v-model="recommend.status" id="input-status" class="form-control">
                                    <option value="1" >启用</option>
                                    <option value="0">禁用</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include $this->template('common/footer', TEMPLATE_INCLUDEPATH, "sm_shop")?>
<script>
    var vue = new Vue( {
        el:'#container',
        data:function(){
            return {


                config:{
                    web_url:'<?php echo $this->url_pre;?>'
                },
                goods_filter:'',
                search_list:[],
                goods_list:[],
                search_list_show:0,
                recommend:{
                    title:'',
                    status:'0',
                    goods_list:[],
                }
            }
        },

        methods:{

            clear_dropdown:function(){

                this.search_list_show = 0;

            },

            goods_search:function(){

                var t = this;
                var url = this.config.web_url + '&r=goods.search';
                url += '&filter=' + this.goods_filter;
                this.search_list_show = 0;
                axios.get( url ).then(function( res ){

                    t.search_list = res.data;
                    t.search_list_show = 1;

                });

            },

            delete_goods:function( item ){

                var index = this.goods_list.indexOf( item );
                this.goods_list.splice( index, 1 );

            },

            check_goods:function( item ){

                var existed = 0;
                for(var i = 0; i < this.goods_list.length; i ++  ){
                    if( this.goods_list[i].id == item.goods_id ){
                        existed = 1;
                        break;
                    }
                }

                if( !existed ){
                    this.goods_list.push( item );
                }


            },

            get_recommend:function(){

                var t = this;
                var url = this.config.web_url + '&r=recommend.index';

                axios.get( url ).then(function( res ){

                    t.recommend = res.data;

                    t.goods_list = res.data.goods_list;

                });

            },

            save:function(){

                var t = this;
                var url = this.config.web_url + '&r=recommend.save';

                var data = '';
                data += '&title=' + this.recommend.title;
                data += '&status=' + this.recommend.status;

                var goods_list_str = '';
                for(var i = 0; i < this.goods_list.length; i ++ ){
                    goods_list_str += this.goods_list[i].id + ',';
                }
                goods_list_str = goods_list_str.replace(/^([\s,]+)|([\s,]+)$/, '');
                data += '&goods_list=' + goods_list_str;

                axios.post( url, data ).then(function( res ){


                    t.get_recommend();

                });

            }

        },

        created:function(){

            this.get_recommend();
        }

    });
</script>

<style scoped>

</style>