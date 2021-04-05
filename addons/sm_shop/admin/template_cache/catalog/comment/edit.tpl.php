<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH, "sm_shop")?>

<div id="container">
    <?php include $this->template('common/nav', TEMPLATE_INCLUDEPATH, "sm_shop")?>

    <div id="content" v-on:click="clear_dropdown()">
        <div class="page-header">
            <div class="container-fluid">
                <div class="pull-right">
                    <a data-toggle="tooltip" title="" class="btn btn-primary"
                            v-on:click="do_edit()"
                            data-original-title="保存">
                        <i class="fa fa-save"></i>
                    </a>

                    <a v-bind:href="config.web_url + '&r=goodsComment.page_list'"
                       data-toggle="tooltip" title="" class="btn btn-default" data-original-title="取消">
                        <i class="fa fa-reply"></i>
                    </a>
                </div>
                <h1>商品评论</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="">首页</a>
                    </li>
                    <li>
                        <a href="">商品评论</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> 编辑商品评论</h3>
                </div>
                <div class="panel-body">

                    <form action="" class="form-horizontal">

                        <div class="tab-content">

                            <div class="tab-pane active" id="tab-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" >作者</label>
                                    <div class="col-sm-10">
                                        <input type="text" v-model="info.author" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" >头像</label>
                                    <div class="col-sm-10" id="avatar"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-parent">商品</label>
                                    <div class="col-sm-10">
                                        <input type="text" v-model="goods.name" v-on:keyup="search()"
                                               class="form-control" autocomplete="off">
                                        <span class="help-block">(自动完成)</span>
                                        <ul class="dropdown-menu" v-bind:style="{display:search_list_show==1?'block':'none'}" style="top: 36px; left: 15px;">
                                            <li v-on:click="check_path( '' )" ><a > ---无--- </a></li>
                                            <li v-on:click="check_path( item )" v-for="item in search_list"><a >{{item.name}}</a></li>
                                        </ul>
                                        <input type="hidden" v-model="info.goods_id" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-date">评论日期</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <input type="text" value=""
                                                   data-date-format="YYYY-MM-DD"
                                                   id="input-date" class="form-control" >
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-content">内容</label>
                                    <div class="col-sm-10">
                                        <textarea name="text" cols="60" rows="8" id="input-content"
                                                   v-model="info.content" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" >评分</label>
                                    <div class="col-sm-10">
                                        <label class="radio-inline">
                                            <input v-model="info.score" type="radio" name="rating" value="1">
                                            1
                                        </label>
                                        <label class="radio-inline">
                                            <input v-model="info.score" type="radio" name="rating" value="2">
                                            2
                                        </label>
                                        <label class="radio-inline">
                                            <input v-model="info.score" type="radio" name="rating" value="3">
                                            3
                                        </label>
                                        <label class="radio-inline">
                                            <input v-model="info.score" type="radio" name="rating" value="4">
                                            4
                                        </label>
                                        <label class="radio-inline">
                                            <input v-model="info.score" type="radio" name="rating" value="5">
                                            5
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" >晒图</label>
                                    <div class="col-sm-10">
                                        <div class="order-review-img-box">
                                            <a v-for="item in img_show"
                                               class="order_review-fancybox" >
                                                <img v-show="item.base64" v-bind:src="item.base64"
                                                     class="img-responsive">
                                                <img v-show="!item.base64" v-bind:src="item.url"
                                                     class="img-responsive">
                                                <i class="cross" v-on:click="remove_img_dom( item )">x</i>
                                            </a>
                                            <input type="hidden" name="images[]" value="review/review-image-1599039383-277276.png">
                                        </div>
                                        <a id="button-upload"
                                                v-on:click="img_upload()"
                                                data-original-title="上传(注意：上传图片大小不能超过1MB)"
                                                data-loading-text="加载中..." class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i></a>
                                        <input type="file" id="file-img" class="hidden">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-status">状态</label>
                                    <div class="col-sm-10">
                                        <select v-model="info.status" id="input-status" class="form-control">
                                            <option value="0">禁用</option>
                                            <option value="1" >启用</option>
                                        </select>
                                    </div>
                                </div>
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
    var vue = new Vue({

        el:'#container',
        data:function(){

            return {

                config:{

                    web_url:'<?php echo $this->url_pre;?>',
                },
                comment_id:0,

                search_list_show : 0,
                search_list:[],
                info:{
                    author:'',
                    avatar:'',
                    customer_id:0,
                    goods_id:0,
                    goods:{},
                    date:'',
                    content:'',
                    images:[],
                    score:0,
                    status:0,
                },
                goods:{
                    name:''
                },

                img_show:[],
                image:{
                    url:''
                }
            }

        },

        methods:{

            clear_dropdown:function(){

                this.search_list_show = 0;

            },

            search:function(){

                var t = this;
                var url = this.config.web_url + '&r=goods.search';
                url += '&filter=' + this.goods.name;
                this.search_list_show = 0;
                axios.get( url ).then(function( res ){

                    t.search_list = res.data;
                    t.search_list_show = 1;

                });
            },

            check_path:function( path ){

                if( path ){
                    this.goods = path;
                    this.info.goods_id = path.id;
                }

            },

            do_edit:function(){

                var t = this;
                var url = this.config.web_url + '&r=goodsComment.edit';
                url += '&id=' + this.comment_id;

                // for(var p in this.img_show ){
                //     if( this.img_show[p].base64 ){
                //         this.img_show[p].base64 = encodeURIComponent( this.img_show[p].base64 );
                //     }
                // }

                var images = [];
                for(var i = 0 ; i < 3; i ++ ){
                    images[i] = '';
                    if( this.img_show[i] ){
                        if( this.img_show[i].base64 ){
                            images[i] = this.img_show[i].base64;
                            images[i] = encodeURIComponent( images[i] );
                            // images[i] = encodeURIComponent( images[i] );
                        }else if( this.img_show[i].path ){
                            images[i] = this.img_show[i].path;
                        }
                    }
                }



                var data = {
                    author      : this.info.author,
                    avatar      : $('input[name="avatar"]').val(),
                    customer_id : this.info.customer_id,
                    goods_id    : this.info.goods_id,
                    date        : $('#input-date').val(),
                    // images      : encodeURIComponent(JSON.stringify( this.img_show )),
                    images_0    : images[0],
                    images_1    : images[1],
                    images_2    : images[2],

                    score       : this.info.score,
                    content     : this.info.content,
                    status      : this.info.status,
                };

                var data_str = '';
                for( var p in data ){
                    data_str += p + '=' + data[p] + '&';
                }

                axios.post( url, data_str ).then(function( res ){

                    if( res.data.status == 0 ){
                        location.href = t.config.web_url + '&r=goodsComment.page_list';
                    }else{
                        alert( res.data.description );
                    }

                });

            },

            single:function(){

                var t = this;

                var url = this.config.web_url + '&r=goodsComment.single';
                url += '&id=' + this.comment_id;
                axios.get( url ).then(function( res ){

                    t.info = res.data;
                    t.goods = res.data.goods;
                    t.img_show = res.data.img_show;
                    $('#input-date').val( res.data.date );
                    t.image.url = t.info.image;

                    t.init_avatar();
                });
            },

            editImage:function( image ){

                gallery.open( image );

            },


            init_datetimepicker:function(){

                $('#input-date').datetimepicker({
                    format:'yyyy-mm-dd',
                    startView: "month", //初始化视图是‘月’
                    minView: "month",//最精确视图为'月'
                    maxView: "decade",//最高视图为'十年'
                    language:'zh-CN'
                });

            },

            // 图片上传
            img_upload:function(){

                document.getElementById('file-img').value = '';
                if( this.img_show.length < 3 ){
                    $('#file-img').click();
                }else{
                    alert('最多上传3张图片');
                }

            },

            add_img_dom:function( item ){
                this.img_show.push( item );

            },
            remove_img_dom:function( item ){

                var index = this.img_show.indexOf( item );
                this.img_show.splice(index, 1);
            },

            // 初始化图片
            init_input_file:function(){

                var t = this;
                document.getElementById('file-img').onchange = function( e ){

                    console.log( e.target.files[0] );
                    var file = e.target.files[0];                 //因为每次只上传了一张图片，所以获取到flObj.files[0];

                    var fReader = new FileReader();

                    fReader.onload = function(e){
                        var item = {
                            // file:file,
                            base64:this.result
                        };
                        t.add_img_dom( item );
                    };
                    fReader.readAsDataURL(file);
                }
            },

            init_avatar:function( ){
                var t = this;
                var params = {
                    append_dom:'#avatar',
                    name:'avatar',
                    value: this.info.avatar,
                };
                get_field_image( params, function( res ){
                    var field_avatar = res.data;
                    console.log( field_avatar );
                });


            }

        },

        created:function(){

            var t= this;
            var comment_id = getQueryString( 'comment_id' );
            if( !comment_id ){
                this.comment_id = 0;
                this.init_avatar();
            }else{
                this.comment_id = comment_id;
                this.single();
            }



            setTimeout(function(){
                t.init_datetimepicker();
                t.init_input_file();
            });

        }

    });
</script>
