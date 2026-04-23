<?php
include_once ROOT_VIEW_DIR . '/admin/head.html.php';
include_once ROOT_VIEW_DIR . '/admin/top.html.php';
?>
<div class="container_12">
<button id="create_index">生成主页</button> <br /><br />
<button id="create_ty">生成内页</button> <span id="str_text"></span> <span id="create_num" style="color:red">0</span><br /> 
</div>
<script type="text/javascript">
//<![CDATA[
window.addEvent('domready', function () {
    $('create_index').addEvent('click', function (e) {
        $('create_num').set('text', 0);
        var request = new Request({
            url    : '/index.php?module=admin&controller=site&action=cindex',
            async  : false
        }).send();
        $('str_text').set('text', '生成成功!');
        $('create_num').set('text', $('create_num').get('text').toInt() + 1);
    });

    $('create_ty').addEvent('click', function (e) {
        $('create_num').set('text', 1);
        var channel = <?php echo json_encode($channel, true); ?>;
        var type    = <?php echo json_encode($type, true); ?>;
        var article = <?php echo json_encode($article, true); ?>;
        var honor = <?php echo json_encode($honor, true); ?>;
        var article_type = <?php echo json_encode($article_type, true); ?>;
        var topic   = <?php echo json_encode($topic, true); ?>;
        var counts  = <?php echo json_encode($count, true); ?>;
        var honor_count  = <?php echo (int) $honor_count; ?>;
        for (tid in topic) {
            var url = '/index.php?module=admin&controller=site&action=ct&c=topic&a=index&sn=' + tid;
            var request = new Request({
                url : url,
                async : false
            }).send();
            $('str_text').set('text', '生成专题 ' + topic[tid]['name'] + ' 页面');
            $('create_num').set('text', $('create_num').get('text').toInt() + 1);
        }

        for (tsn in article_type) {
            if (counts[tsn] > 1) {
                var len = counts[tsn] + 1;
                for (var i = 1; i < len; i++) {
                    var url = '/index.php?module=admin&controller=site&action=ct&c=article&a=type&sn=' + tsn + '&page=' + i;
                    var request = new Request({
                        url : url,
                        async : false
                    }).send();
                    $('str_text').set('text', '生成文章分页 列表 页面');
                    $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                }
            }
        }

        for (id in channel) {
            $('str_text').set('text', '渠道' + channel[id]['name']);
            if ('20c758aa-96be-42e2-b097-5a05b78a33d7' === id) { //生成关于我们页面
                $('str_text').set('text', '生成关于我们页面');
                for (ids in type) {
                    if ((id === type[ids]['parent_sn']) && '697df8f8-7af2-4db1-8561-2aabd43a136d' !== ids) {
                        var url = '/index.php?module=admin&controller=site&action=ct&c=about&a=article&sn=' + ids;
                        var request = new Request({
                            url : url,
                            async : false
                        }).send();
                        $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                    }
                }
                //生成相关资质
                $('str_text').set('text', '生成相关资质');
                var url = '/index.php?module=admin&controller=site&action=cth&c=honor&a=list';
                var request = new Request({
                    url : url,
                    async : false
                }).send();
                $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                if (honor_count > 1) {
                    for (var i = 1; i < honor_count; i++) {
                        var url = '/index.php?module=admin&controller=site&action=ctd&c=honor&a=list&page=' + i;
                        var request = new Request({
                            url : url,
                            async : false
                        }).send();
                        $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                    }
                }
                for (honor_id in honor) {
                    var url = '/index.php?module=admin&controller=site&action=ct&c=honor&a=article&sn=' + honor_id;
                    var request = new Request({
                        url : url,
                        async : false
                    }).send();
                    $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                }
            }
            
            if ('65ec02fc-1e94-4093-8c2c-497d5eaea547' === id) { //产品列表
                $('str_text').set('text', '生成产品页面');
                var url = '/index.php?module=admin&controller=site&action=ct&c=product&a=type';
                var request = new Request({
                    url : url,
                    async : false
                }).send();
                $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                if (counts[id] > 1) {
                    var len = counts[id] + 1;
                    for (var i = 1; i < len; i++) {
                        var url = '/index.php?module=admin&controller=site&action=ct&c=product&a=type&page=' + i;
                        var request = new Request({
                            url : url,
                            async : false
                        }).send();
                        $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                    }
                } 
                for (ids in type) {
                    if ((id === type[ids]['parent_sn'])) {
                        var url = '/index.php?module=admin&controller=site&action=ct&c=product&a=type&sn=' + type[ids]['sn'];
                        var request = new Request({
                            url : url,
                            async : false
                        }).send();
                        $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                        for (asn in article) {
                            if (ids === article[asn]['type_sn']) {
                                var url = '/index.php?module=admin&controller=site&action=ct&c=product&a=article&sn=' + asn;
                                var request = new Request({
                                    url : url,
                                    async : false
                                }).send();
                                $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                            }
                        }
                    }
                }
            }

            if ('c96377f1-15a5-4ac2-93c7-7ef436bafc96' === id) { //案例列表
                console.log('1213234324');
                var url = '/index.php?module=admin&controller=site&action=ct&c=special&a=type';
                var request = new Request({
                    url : url,
                    async : false
                }).send();
                $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                //if (counts[id] > 1) {
                if (counts['90dc2b73-2ab3-4a28-8b94-f63c61a5e44f'] > 1) {
                    //var len = counts[id] + 1;
                    var len = counts['90dc2b73-2ab3-4a28-8b94-f63c61a5e44f'] + 1;
                    for (var i = 1; i < len; i++) {
                        var url = '/index.php?module=admin&controller=site&action=ct&c=special&a=type&page=' + i;
                        var request = new Request({
                            url : url,
                            async : false
                        }).send();
                        $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                    }
                } 
                for (ids in type) {
                    if ((id === type[ids]['parent_sn'])) {
                        var url = '/index.php?module=admin&controller=site&action=ct&c=special&a=type&sn=' + type[ids]['sn'];
                        var request = new Request({
                            url : url,
                            async : false
                        }).send();
                        $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                        for (asn in article) {
                            if (ids === article[asn]['type_sn']) {
                                var url = '/index.php?module=admin&controller=site&action=ct&c=special&a=article&sn=' + asn;
                                var request = new Request({
                                    url : url,
                                    async : false
                                }).send();
                                $('str_text').set('text', '生成案例页面');
                                $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                            }
                        }
                    }
                }
            }


            if ('9f709ef3-a790-4cdc-80cb-8b1c32ee996c' === id) { //文章列表
                var url = '/index.php?module=admin&controller=site&action=ct&c=article&a=type';
                var request = new Request({
                    url : url,
                    async : false
                }).send();
                $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                if (counts[id] > 1) {
                    var len = counts[id] + 1;
                    for (var i = 1; i < len; i++) {
                        var url = '/index.php?module=admin&controller=site&action=ct&c=article&a=type&page=' + i;
                        var request = new Request({
                            url : url,
                            async : false
                        }).send();
                        $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                    }
                } 

                for (ids in type) {
                    if (counts[ids] > 1) {
                        var len = counts[ids] + 1;
                        for (var i = 1; i < len; i++) {
                            var url = '/index.php?module=admin&controller=site&action=ct&c=article&a=type&page=' + i;
                            var request = new Request({
                                url : url,
                                async : false
                            }).send();
                            $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                        }
                    } 

                    if ((id === type[ids]['parent_sn'])) {
                        var url = '/index.php?module=admin&controller=site&action=ct&c=article&a=type&sn=' + type[ids]['sn'];
                        var request = new Request({
                            url : url,
                            async : false
                        }).send();
                        $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                        for (asn in article) {
                            if (ids === article[asn]['type_sn']) {
                                var url = '/index.php?module=admin&controller=site&action=ct&c=article&a=article&sn=' + asn;
                                var request = new Request({
                                    url : url,
                                    async : false
                                }).send();
                                $('str_text').set('text', '生成文章页面');
                                $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                            }
                        }
                    }
                }
            }

            //72b40d55-c565-4785-8141-77949c5e9614
            if ('72b40d55-c565-4785-8141-77949c5e9614' === id) {//下载中心
                var url = '/index.php?module=admin&controller=site&action=ctd&c=download&a=type';
                var request = new Request({
                    url : url,
                    async : false
                }).send();
                $('str_text').set('text', '生成下载页面');
                $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                if (counts[id] > 1) {
                    var len = counts[id] + 1;
                    for (var i = 1; i < len; i++) {
                        var url = '/index.php?module=admin&controller=site&action=ctd&c=download&a=type&page=' + i;
                        var request = new Request({
                            url : url,
                            async : false
                        }).send();
                        $('create_num').set('text', $('create_num').get('text').toInt() + 1);
                    }
                } 
            }

            if ('40c74315-9390-4f01-8021-0e64c321efed' === id) {
            }
        }
    });
});
//]]>
</script>
<?php
include_once ROOT_VIEW_DIR . '/admin/foot.html.php';
?>
