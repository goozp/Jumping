<hr>

<footer class="footer">

    <div class="container">
        <?php
        if (jumping_setting('footerType') == '0'){
            ?>
            <div class="col-xs-12 col-sm-12">
                <div class="col-xs-12 col-sm-12">
                    <ul class="footer_links">
                        <li>友情链接：</li>
                        <?php wp_list_bookmarks('title_li=&categorize=0&orderby=rand&show_images=0'); ?>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <br>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <p>Copyright © 2017 <a id="footer_name" href="<?php bloginfo( 'url' ); ?>" target="_blank"><?php bloginfo( 'name' ); ?></a>
                    All Rights Reserved. Jumping theme powered by <a href="http://www.gzpblog.com" target="_blank">guo</a>.</p>
            </div>
        <?php
        } elseif (jumping_setting('footerType') == '1') {
            ?>
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <div class="col-xs-12 col-sm-8 col-lg-8">
                <div class="col-xs-12 col-sm-12 footer_links_label">
                    <p>友情链接</p>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <ul class="footer_links">
                        <?php wp_list_bookmarks('title_li=&categorize=0&orderby=rand&show_images=0'); ?>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="col-xs-12 col-sm-12">
                    <p>微信公众号</p>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <p><img src="<?php echo jumping_image('wechatPic.png'); ?>"  alt="微信公众号二维码" width="150px"/></p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <p class="footer_word">Copyright © 2017 <a id="footer_name" href="<?php bloginfo( 'url' ); ?>" target="_blank"><?php bloginfo( 'name' ); ?></a>
                All Rights Reserved. Jumping theme powered by <a href="http://www.gzpblog.com" target="_blank">guo</a>.</p>
            <p>
                <a href="http://www.miitbeian.gov.cn/">粤ICP备16013442号</a>&nbsp|&nbsp<a href="/sitemap.xml">网站地图</a>&nbsp|&nbsp

                <!-- cnzz统计 -->
                <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan 		   id='cnzz_stat_icon_1257421693'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1257421693%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
            </p>
        </div>
        <?php
        } ?>
    </div>
</footer>


<?php wp_footer(); ?>

</body>
</html>