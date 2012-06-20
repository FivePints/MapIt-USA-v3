<?= $template['partials']['backend-header']; ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">Library</a> <span class="divider">/</span>
                    </li>
                    <li class="active">Data</li>
                </ul>
            </div>
            <div class="row-fluid">
                <div class="span3">
                  <div class="well sidebar-nav">
                        <?= $template['partials']['backend-sidebar']; ?>
                  </div><!--/.well -->
                </div><!--/span-->

                <div class="span9">
                    <h1><?= $template['title']; ?></h1>
                    <?php if ($page['announcements'] != FALSE){
                        foreach ($page['announcements'] as $announcements): ?>
                            <div class="admin-notice alert <?= $announcements->message_type; ?>">
                                <?php if ($announcements->hideable != 0): ?><span class="hide">x</span><?php endif; ?>
                                <?php if ($announcements->title != ''): ?><strong><?= $announcements->title; ?>:</strong> <?php endif;?>
                                <?= $announcements->message; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php } ?>
                    <?= $template['body']; ?>
                </div>
            </div>
            <div class="row-fluid">
                <footer id="footer">
                    <div class="footer-icon align-center"><a class="top" href="#top"></a></div>
                </footer>
            </div>
        </div>
    <?= $template['partials']['backend-absfooter']; ?>
    <script type="text/javascript">
        <?= $template['metadata']; ?>
    </script>
    </body>
</html>