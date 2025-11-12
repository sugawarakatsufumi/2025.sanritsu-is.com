<?php $isRoot = ($_SERVER['REQUEST_URI'] === '/'); ?>
  <header class="header">
    <div class="header-inner">
      <<?php if ($isRoot): ?>h1<?php else: ?>div<?php endif; ?> class="header-logo">
        <a href="/" class="header-logo-link">
          <img src="/assets/img/common/logo.svg" alt="株式会社三立">
        </a>
      </<?php if ($isRoot): ?>h1<?php else: ?>div<?php endif; ?>>
      <nav class="sp-g-nav-btn sp-only">
        <svg class="nav-btn-off" xmlns="http://www.w3.org/2000/svg" width="32.5" height="35.5" viewBox="0 0 32.5 35.5">
          <g id="コンポーネント_21_1" data-name="コンポーネント 21 – 1" transform="translate(1 1)">
            <line id="線_45" data-name="線 45" x2="30" transform="translate(0 10)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2"/>
            <line id="線_46" data-name="線 46" x2="30" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2"/>
            <line id="線_47" data-name="線 47" x2="30" transform="translate(0 20)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2"/>
          </g>
          <text id="メニュー" transform="translate(16.5 33.5)" font-size="8" font-family="NotoSansJP-Medium, Noto Sans JP" font-weight="500"><tspan x="-16" y="0">メニュー</tspan></text>
        </svg>
        <svg class="nav-btn-on" xmlns="http://www.w3.org/2000/svg" width="24.521" height="36.521" viewBox="0 0 24.521 36.521">
          <g id="コンポーネント_21_1" data-name="コンポーネント 21 – 1" transform="translate(1.414 1.414)">
            <line id="線_45" data-name="線 45" x2="30" transform="rotate(45)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2"/>
            <line id="線_65" data-name="線 65" x2="30" transform="translate(21.213 0.001) rotate(135)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2"/>
          </g>
          <text id="閉じる" transform="translate(12.521 34.521)" font-size="8" font-family="NotoSansJP-Medium, Noto Sans JP" font-weight="500"><tspan x="-12" y="0">閉</tspan><tspan y="0">じる</tspan></text>
        </svg>
      </nav>
      <nav class="g-nav">
        <ul class="g-nav-list">
          <li class="g-nav-list__item"><a href="/#company-info">会社概要</a></a></li>
          <li class="g-nav-list__item"><a href="/#prod">サービス</a></a></li>
          <li class="g-nav-list__item"><a href="/#biz-partner">取引実績</a></a></li>
          <li class="g-nav-list__item"><a href="/news/">ニュース</a></a></li>
          <li class="g-nav-list__item sp-only"><a href="/privacy">プライバシーポリシー</a></li>
          <li class="g-nav-list__item sp-only"><a href="/sitemap">サイトマップ</a></li>
          <li class="g-nav-list__item contact-button pc-only"><a href="/inquiry.php" class="sr-btn-primary">お問い合せ&nbsp;&nbsp;<span class="sr-icon-right-arrow"></span></a></li>
        </ul>
        <div class="g-nav-add-tel-social sp-only">
          <address class="address-info">
            <a href="https://www.google.com/maps/search/?api=1&query=東京都千代田区東神田2-9-2+第二坂本ビル5階+101-0031" target="_blank">〒101-0031<br>東京都千代田区東神田2-9-2第二坂本ビル5階 <i class="sr-icon-external"></i></a><br>
            TEL 03-6265-3687<br>
            FAX 03-6265-3686
          </address>
          <ul class="social-nav-list">
            <li class="social-nav-item">
              <a href="https://www.facebook.com/people/Sanritsu-Vending-Company/100063564371771/" target="_blank" class="social-link social-link--facebook" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            </li>
            <li class="social-nav-item">
              <a href="https://x.com/sanritsujp/" target="_blank" class="social-link social-link--x" aria-label="X (旧Twitter)"><i class="bi bi-twitter-x"></i></a>
            </li>
            <li class="social-nav-item">
              <a href="https://www.youtube.com/channel/UCUDX7ORSSTiaRoTJyulhX4g" target="_blank" class="social-link social-link--youtube" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
            </li>
            <li class="social-nav-item">
              <a href="https://www.instagram.com/sanritsujp/" target="_blank" class="social-link social-link--instagram" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            </li>
          </ul>
        </div>
        <nav class="g-nav-cta sp-only">
          <ul class="g-nav-cta-list">
            <li class="g-nav-cta-list__item link-tel">
              <a href="tel:03-6265-3687">
                <i class="sr-icon-telphone"></i>
                お電話で相談
                <i class="sr-icon-right-arrow"></i>
              </a>
            </li>
            <li class="g-nav-cta-list__item link-inquiry">
              <a href="/inquiry/">
                <i class="sr-icon-mail"></i>
                お問い合せ・資料請求
                <i class="sr-icon-right-arrow"></i>
              </a>
            </li>
          </ul>
        </nav>
      </nav>
    </div>
  </header>
  