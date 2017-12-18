<header class="top-affix" data-spy="affix" data-offset-top="200">
    <div class="main-header container-fluid">
        <div class="container">
            <div class="row flex-between">
                <div class="col-xs-12 col-lg-5 col-sm-4 logo-header flex-start"> <? // Left  ?>
                    <a class="txtlogo" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                    <div class="menu-contact flex-center">
                        <a href="mailto:new@saowapan.com?subject=smiles go" class="icon-contact fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-flag fa-stack-1x fa-envelope"></i>
                        </a>
                        <div class="content-contact">
                            <p>Do you have any questions?</p>
                            <a href="tel:06-3082-6001">06-3082-6001</a>
                        </div>
                        <div class="mobile">
                            <a href="tel:06-3082-6001" class="icon-contact fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-flag fa-stack-1x fa-phone"></i>
                            </a>
                        </div>
                        <?php if (is_page('search-clinic')) { ?>
                            <div class="mobile-thb_aud">
                                <a class="thb icon-contact fa-stack fa-lg" style="cursor: pointer;">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-thb"></i>
                                </a>
                                <a class="aud icon-contact fa-stack fa-lg" style="cursor: pointer;">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flag fa-stack-1x fa-aud"></i>
                                </a>
                            </div> 
                        <?php } ?>    
                    </div> 
                </div>
                <div class="col-xs-12 navbar-header"> <? // Mobile  ?>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu-smilesgo">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <nav class="col-xs-12 col-lg-7 col-sm-8" role="navigation"><? // sub-header ?>
                    <div id="main-menu-smilesgo" class="sm-hide collapse navbar-collapse">
                        <div class="row">
                            <ul class="menu-smilesgo list-unstyled">
                                <li class=""><a href="<?= esc_url(home_url('/clinics/'))?>">Search Clinic</a></li>
                                <li><a href="<?= esc_url(home_url('/experts/')); ?>">Expert</a></li>
                                <li><a href="<?= esc_url(home_url('/about/')); ?>">About</a></li>
                                <li><a href="<?= esc_url(home_url('/contact')); ?>">Get a quote</a></li>                    
                                <?php if (is_page('search-clinic') || is_page('search-clinics')) {
                                    echo '<li class="xs-hide">';
                                    echo '<a class="btn-main btn-custom thb" style="cursor: pointer;">THB <i class="fa fa-long-arrow-right"></i> AUD</a>';
                                    echo '<a class="btn-main btn-custom aud" style="cursor: pointer;">AUD <i class="fa fa-long-arrow-right"></i> THB</a>';
                                    echo '</li>';
                                }?>
                            </ul>
                        </div>
                    </div>            
                </nav>  
            </div>
         </div>    
    </div>
</header>