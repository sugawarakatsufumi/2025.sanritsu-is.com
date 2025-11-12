<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>三立WEBサイト</title>
    <meta name="description" content="サイトの説明文">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
  <?php include 'inc_header.php'; ?>
  <?php include 'inc_pankz.php'; ?>
  <main class="main">
    <div class="container">
      <section class="lower-section width-col1">
        <h1 class="lower-ttl-h1">お問い合わせフォーム</h1>
        <p class="lower-desc">弊社への各種お問い合わせはこちらより。※営業や広告に関するご連絡はご遠慮願います。</p>
        <div class="sr-form-container">
          
          <div class="sr-form-group">
            <label for="company" class="sr-form-label">会社名</label>
            <div class="sr-form-input">
              <input type="text" name="company" id="company" class="company" size="40" value="">
            </div>
          </div>
          
          <div class="sr-form-group">
            <label for="name" class="sr-form-label">担当者氏名<span>※必須</span></label>
            <div class="sr-form-input">
              <input type="text" name="name" id="name" class="name" size="40" value="" required>
            </div>
          </div>
          
          <div class="sr-form-group">
            <label for="furigana" class="sr-form-label">フリガナ<span>※必須</span></label>
            <div class="sr-form-input">
              <input type="text" name="furigana" id="furigana" class="furigana" size="40" value="" required>
            </div>
          </div>
          
          <div class="sr-form-group">
            <label for="address" class="sr-form-label">住所</label>
            <div class="sr-form-input">
              <input type="text" name="address" id="address" class="address" size="60" value="">
            </div>
          </div>
          
          <div class="sr-form-group">
            <label for="tel" class="sr-form-label">TEL</label>
            <div class="sr-form-input">
              <input type="text" name="tel" id="tel" class="tel" size="40" value="">
            </div>
          </div>
          
          <div class="sr-form-group">
            <label for="fax" class="sr-form-label">FAX</label>
            <div class="sr-form-input">
              <input type="text" name="fax" id="fax" class="fax" size="40" value="">
            </div>
          </div>
          
          <div class="sr-form-group">
            <label for="email" class="sr-form-label">Email<span>※必須</span></label>
            <div class="sr-form-input">
              <input type="text" name="email" id="email" class="email" size="40" value="" required>
            </div>
          </div>
          
          <div class="sr-form-group">
            <label for="msg" class="sr-form-label">お問い合わせ本文</label>
            <div class="sr-form-input">
              <textarea name="msg" id="msg" class="msg" cols="50" rows="4"></textarea>
            </div>
          </div>
        </div>
        <div class="sr-submit">
          <input type="submit" name="submitBack" value="戻る">
          <input type="submit" name="submitConfirm" value="確認画面へ">
        </div>
      </section>
    </div>
  </main>
  <?php include 'inc_footer.php'; ?>
</body>
</html>