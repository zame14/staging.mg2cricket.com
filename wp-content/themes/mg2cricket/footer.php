<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner-wrapper">
                    <div class="f-col-1">
                        <h3>MG2 Cricket</h3>
                        <address><?=get_field('mg2_address',5)?></address>
                        <ul>
                            <li><a href="tel:<?=formatPhoneNumber(get_field('mg2_phone', 5))?>"><span class="fa fa-phone"></span> <?=get_field('mg2_phone', 5)?></a></li>
                            <li><a href="mailto:<?=get_field('mg2_email', 5)?>"><span class="fa fa-envelope"></span> <?=get_field('mg2_email', 5)?></a></li>
                        </ul>
                    </div>
                    <div class="f-col-2">
                        <h3>Links</h3>
                        <?=mainMenu()?>
                    </div>
                    <div class="f-col-3">
                        <h3>Follow Us</h3>
                        <ul>
                            <li><a href="<?=get_field('mg2_facebook',5)?>" target="_blank"><span class="fa fa-facebook-square"></span></a></li>
                            <li><a href="<?=get_field('mg2_instagram',5)?>" target="_blank"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="copyright">
                    <ul>
                        <li>&copy; Copyright <?=date('Y')?> <?=get_bloginfo('name')?></li>
                        <li class="site-by">Custom Website by <a href="https://www.azwebsolutions.co.nz/" target="_blank">A-Z Web Solutions<span class="az"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
</div><!-- #page we need this extra closing tag here -->
<?php wp_footer(); ?>
<script src="<?=get_stylesheet_directory_uri()?>/js/theme.js" type="text/javascript"></script>
</body>
</html>