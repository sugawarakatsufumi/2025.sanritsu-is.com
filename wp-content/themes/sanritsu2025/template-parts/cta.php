<?php
  $cta_catch_copy = isset($args['catch']) ? $args['catch'] : '<span class="main-cta-ttl-line">まずは気軽に</span><br class="sp-only"><span class="main-cta-ttl-line">お問合せください</span>';
?>
<section class="main-cta">
  <div class="main-cta-inner container">
    <h2 class="main-cta-ttl"><?php echo $cta_catch_copy; ?></h2>
    <span class="main-cta-note">お問い合わせの際は<br class="sp-only">ホームページをみたとお伝えください。</span>
    <ul class="main-cta-list">
      <li class="main-cta-item">
        <a href="tel:0423614819" class="main-cta-btn sr-btn-light">
          <span class="main-cta-btn-left">
            <span class="sr-icon-telphone"></span>
            <span class="main-cta-btn-text">042-361-4819</span>
          </span>
          <span class="sr-icon-right-arrow"></span>
        </a>
      </li>
      <li class="main-cta-item">
        <a href="/contact/" class="main-cta-btn sr-btn-primary">
          <span class="main-cta-btn-left">
            <span class="sr-icon-mail"></span>
            お問い合わせフォーム
          </span>
          <span class="sr-icon-right-arrow"></span>
        </a>
      </li>
    </ul>
  </div>
</section>