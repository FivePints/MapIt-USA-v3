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
                    <?php if( $this->session->flashdata('messages') ): $m = $this->session->flashdata('messages'); ?>
                        <div class="alert alert-<?= $m['type']; ?>">
                          <button class="close" data-dismiss="alert">×</button>
                          <?= $m['message']; ?>
                        </div>
                    <?php endif; ?>
                    <h1><?= $template['title']; ?></h1>
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