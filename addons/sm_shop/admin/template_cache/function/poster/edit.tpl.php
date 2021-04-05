<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH)?>
<link href="/addons/sm_shop/admin/assets/css/jquery.contextMenu.css" rel="stylesheet">
<script src="/addons/sm_shop/admin/assets/js/designer.js?v=0.0.1"></script>
<script src="/addons/sm_shop/admin/assets/js/jquery.contextMenu.js?v=0.0.1"></script>
<div id="container">
    <?php include $this->template('common/nav', TEMPLATE_INCLUDEPATH)?>

<div id="content" >
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button v-on:click="do_edit()" class="btn btn-primary" data-original-title="保存">
                    <i class="fa fa-save"></i>
                </button>
                <!--<button type="button" id="save-variant" title="" class="btn btn-success" >
                    <i class="fa fa-save"></i>
                </button>-->
                <a v-bind:href="config.web_url + '&r=goods.page_list'" title="" class="btn btn-default" >
                    <i class="fa fa-reply"></i>
                </a>
            </div>
            <h1>商品管理</h1>
            <ul class="breadcrumb">
                <li><a href="#">首页</a></li>
                <li><a href="#">商品管理</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> 编辑海报</h3>
            </div>

            <div class="panel-body">
                <div class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li  class="active">
                            <a href="#tab-base" data-toggle="tab"  >基础</a>
                        </li>
                        <li>
                            <a href="#tab-general" data-toggle="tab">设计</a>
                        </li>

<!--                        <li class="">-->
<!--                            <a href="#tab-image" data-toggle="tab"  >图片</a></li>-->
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane " id="tab-general">
                            <div class="form-group">
                                <div class="col-md-4 " >
                                    <div id="postera" class="poster-design">
                                        <img class="bg" src="" alt="">
                                    </div>


                                </div>
                                <div class="col-md-8">

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="input-name2">背景图</label>
                                        <div class="col-md-10" id="post-bg-image">

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="input-name2">海报元素</label>
                                        <div class="col-md-10">

                                            <button class="btn btn-default btn-com" type="button" data-type="head">头像</button>
                                            <button class="btn btn-default btn-com" type="button" data-type="nickname">昵称</button>
                                            <button class="btn btn-default btn-com" type="button" data-type="qr">二维码</button>
                                            <button class="btn btn-default btn-com" type="button" data-type="img">图片</button>
<!--                                            <button class="btn btn-default btn-com" type="button" data-type="time">失效时间(Y-m-d H:i)</button>-->
                                        </div>
                                    </div>
                                    <div id="nameset" style="display:none">
                                        <div class="form-group" id="nameset-color">
                                            <label class="col-md-2 control-label" for="namecolor">昵称颜色</label>
                                            <div class="col-md-10">
                                                <input id="namecolor" type="color" style="width:60px" class="form-control">
                                            </div>

                                        </div>
                                        <div class="form-group" >
                                            <label class="col-md-2 control-label" for="namesize">昵称字号</label>
                                            <div class="col-md-10">
                                                <input id="namesize" type="text"  value=""
                                                       style="width:60px"
                                                       placeholder="px" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group required " id="qrset"  style="display:none">

                                    </div>

                                    <div class="form-group required" id="imgset" style="display:none">
                                        <label class="col-md-2 control-label" for="input-name2">图片地址</label>
                                        <div class="col-md-10" id="post-image">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="tab-base" >

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="input-name2">名称</label>
                                <div class="col-md-10">
                                    <input type="text"  v-model="info.name"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="input-name2">回复关键字</label>
                                <div class="col-md-10">
                                    <input type="text"  v-model="info.reply"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="input-name2">开始时间</label>
                                <div class="col-md-10">
                                    <input type="date"  v-model="info.date_start"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="input-name2">结束时间</label>
                                <div class="col-md-10">
                                    <input type="date"  v-model="info.date_end"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="input-name2">状态</label>
                                <div class="col-md-10">
                                    <select v-model="info.status" id="input-status" class="form-control">
                                        <option value="0">禁用</option>
                                        <option value="1" >启用</option>
                                    </select>


                                </div>
                            </div>

                        </div>

                        <div class="tab-pane" id="tab-image">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<?php include $this->template('common/footer', TEMPLATE_INCLUDEPATH)?>
<script>

    var vue = new Vue({
        el:'#content',
        data:function(){

            return {

                poster_id:0,
                info:{
                    name        : '',
                    reply       : '',
                    design      : '',
                    bg_img      : '',
                    date_start  : '',
                    date_end    : '',
                    status      : 1,
                },

                config:{
                    web_url:'<?php echo $this->url_pre;?>',
                },

            }
        },

        methods:{

            assign_design:function( design_arr ){

                console.log( design_arr );
                design_arr.forEach(function( design ){
                    var type = design.type;
                    var size = '';
                    var color = '';
                    var img = "";
                    if(type=='qr'){
                        img = '<img src="../addons/ewei_shopv2/plugin/postera/static/images/qr.jpg" />';
                    }
                    else  if(type=='img' || type=='thumb'){
                        // img = '<img src="../addons/ewei_shopv2/plugin/postera/static/images/img.jpg" />';

                        img = '<img src="/attachment/' + design.src + '" />';
                    }
                    else if(type=='nickname'){

                        size = " size=" + design.size.replace('px','');
                        color = " color=" + design.color;
                        img = '<div class=text style="color:' + design.color + ';font-size:'+design.size.replace('px','')+'px">昵称</div>';

                    }
                    else if(type=='time'){
                        img = '<div class=text>失效时间</div>';
                    }  else if(type=='title'){
                        img = '<div class=text>商品名称</div>';
                    }
                    var index = $('#postera .drag').length+1;
                    var obj = $('<div class="drag" ' + size + color + ' type="' + design.type +'" index="' + index +'" src="' + design.src + '" style="z-index:' + index+';left:' + design.pos_left + ';top:' + design.pos_top + ' ">'
                        + img+'<div class="rRightDown"> </div>' +
                        '<div class="rLeftDown"> </div>' +
                        '<div class="rRightUp"> </div>' +
                        '<div class="rLeftUp"> </div>' +
                        '<div class="rRight"> </div>' +
                        '<div class="rLeft"> </div>' +
                        '<div class="rUp"> </div>' +
                        '<div class="rDown"></div>' +
                        '</div>');

                    $('#postera').append(obj);
                    bindEvents(obj);
                })

            },

            get_info:function(){
                var t = this;
                var url = this.config.web_url + '&r=poster.get_info&poster_id=' + this.poster_id;
                axios.get( url ).then(function( res ){

                    t.info = res.data;
                    var design = JSON.parse( t.info.design );
                    // todo

                    t.assign_design( design );
                    get_field_image({
                        append_dom:'#post-bg-image',
                        name:'image',
                        value:t.info.bg_img
                    },function( res ){
                        $('#post-bg-image').find('img')[0].onload = function( evt ){

                            var input = $('#post-bg-image').find('input');
                            $('#postera').attr('src',input.val()).find('img.bg').attr('src',this.src);

                        };

                    });



                });

            },

            do_edit:function(){

                var t = this;
                var json = [];
                //todo 整理，拼接 碎片
                $('.drag').each(function( index ){

                    console.log( this );
                    var attr = {};
                    attr.type = $(this).attr('type');
                    if( attr.type == 'img' ){

                        attr.src = $(this).attr('src')

                    }else if( attr.type == 'nickname' || attr.type=='time' ){
                        attr.color = $(this).attr('color') || "#000";
                        attr.size = $(this).attr('size') || "16";
                    }

                    attr.pos_left = $(this)[0].style.left;
                    attr.pos_top = $(this)[0].style.top;

                    json.push( attr );
                });

                console.log( json );
                //todo 发送请求

                var url = this.config.web_url + '&r=poster.edit';
                if( this.poster_id ){
                    url += '&poster_id=' + this.poster_id;
                }

                var data = {
                    name:this.info.name,
                    bg_img      : $('#postera').attr('src'),
                    design      : JSON.stringify( json ),
                    reply       : this.info.reply,
                    date_start  : this.info.date_start,
                    date_end    : this.info.date_end,
                    status      : this.info.status,

                };
                var data_str = '';
                for(var p in data ){
                    data_str += "&" + p + "=" + data[p]
                }

                axios.post( url, data_str ).then(function( res ){

                    if( res.data.status == 0 ){
                        location.href = t.config.web_url + '&r=poster.page_list';
                    }

                });

            }

        },

        created:function(){

            this.poster_id = getQueryString( 'poster_id' );


            if( this.poster_id ){

                this.get_info();

            }else{

                get_field_image({
                    append_dom:'#post-bg-image',
                    name:'image',
                    value:''
                },function( res ){
                    $('#post-bg-image').find('img')[0].onload = function( evt ){
                        var input = $('#post-bg-image').find('input');
                        $('#postera').attr('src',input.val()).find('img').attr('src',this.src);
                    };
                });

            }

            get_field_image({
                append_dom:'#post-image',
                name:'image',
                value:''
            },function ( res ) {

                $('#imgset').find('img')[0].onload = function( evt ){

                    var dragObj = $('.drag.active');

                    if( dragObj ){
                        var input = $('#imgset').find('input');
                        var url = this.src;
                        dragObj.attr('src',input.val()).find('img').attr('src',url);
                    }
                };

            });

        }

    });

</script>

<style scoped>

    .poster-design{

        width: 320px;
        height: 504px;
        border: 1px solid #cdcdcd;
        position: relative;
    }

    .poster-design .bg{

        width:100%;
        /*height:100%;*/
        position:absolute;
    }

    /* 来自远方的拷贝 ^_^ */

    #postera {
        width:320px;height:504px;border:1px solid #ccc;position:relative
    }
    #postera .bg { position:absolute;width:100%;z-index:0}
    #postera .drag[type=img] img,#postera .drag[type=thumb] img { width:100%;height:100%; }

    #postera .drag { position: absolute; width:80px;height:80px; border:1px solid #000; }


    #postera .drag[type=nickname],#postera .drag[type=time] { width:80px;height:40px; font-size:16px; font-family: 黑体;}
    #postera .drag img {position:absolute;z-index:0;width:100%; }

    #postera .rRightDown,.rLeftDown,.rLeftUp,.rRightUp,.rRight,.rLeft,.rUp,.rDown{
        position:absolute;
        width:7px;
        height:7px;
        z-index:1;
        font-size:0;
    }


    #postera .rRightDown,.rLeftDown,.rLeftUp,.rRightUp,.rRight,.rLeft,.rUp,.rDown{
        background:#C00;
    }
    .rLeftDown,.rRightUp{cursor:ne-resize;}
    .rRightDown,.rLeftUp{cursor:nw-resize;}
    .rRight,.rLeft{cursor:e-resize;}
    .rUp,.rDown{cursor:n-resize;}
    .rLeftDown{left:-4px;bottom:-4px;}
    .rRightUp{right:-4px;top:-4px;}
    .rRightDown{right:-4px;bottom:-4px;}

    .rRightDown{background-color:#00F;}

    .rLeftUp{left:-4px;top:-4px;}
    .rRight{right:-4px;top:50%;margin-top:-4px;}
    .rLeft{left:-4px;top:50%;margin-top:-4px;}
    .rUp{top:-4px;left:50%;margin-left:-4px;}
    .rDown{bottom:-4px;left:50%;margin-left:-4px;}
    .context-menu-layer { z-index:9999;}
    .context-menu-list { z-index:9999;}

</style>