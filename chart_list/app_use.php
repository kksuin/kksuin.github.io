<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>분리수거 앱 관리자 | 앱 접속 횟수</title>
  
  <?php
    include $_SERVER["DOCUMENT_ROOT"]."/include/head.php"
  ?>

  <!-- chart js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.0/dist/chart.min.js"></script>
</head>
<body>
  <!-- header -->
  <?php
    include $_SERVER["DOCUMENT_ROOT"]."/include/header.php"
  ?>
  <!-- aside -->
  <?php
    include $_SERVER["DOCUMENT_ROOT"]."/include/nav.php"
  ?>
  <main>
    <div class="container">
      <h2 class="container-title">앱 접속 횟수</h2>
      <div class="container-wr">
        <div class="contents-wr">
          <div class="search-wr flex-row gap-sm">
            <label class="text-sm">
              날짜별 검색
            </label>
            <input type="text"
            class="input-line datepicker"
            id="date-from">
            <span>-</span>
            <input type="text"
            class="input-line datepicker"
            id="date-to">
            <button type="button"
            class="btn-submit btn-sm">
              검색
            </button>
            <button type="button"
            class="btn-default btn-sm">
              엑셀 다운로드
            </button>
          </div>
          <!-- //serach-wr -->
        </div>
        <!-- //contets-wr -->
        <div class="contents-wr">
          <div class="chart-wr">
            <canvas class="chart"
            id="index-chart"></canvas>
          </div>
        </div>
        <!-- /contets-wr -->
      </div>
      <!-- //container-wr -->
    </div>
    <!-- //container -->
    
  </main>
<script src="/js/chart.js"></script>

  
</body>
</html>