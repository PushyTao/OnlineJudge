<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  @include('layouts.head')
  <title>@yield('title')</title>

  <style type="text/css">
    /* 不同屏幕宽度下的主界面宽度 */
    @media screen and (max-width: 1200px) {
      .container {
        @if (get_setting('web_page_display_wide'))max-width: 1200px;
        @endif
      }
    }

    @media screen and (min-width: 1201px) {
      .container {
        @if (get_setting('web_page_display_wide'))max-width: 96%;
        @endif
      }
    }
  </style>
</head>

<body>
  {{-- 检查微信浏览器，不允许使用微信浏览器 --}}
  @if (stripos($_SERVER['HTTP_USER_AGENT'], 'wechat') !== false ||
      (stripos($_SERVER['HTTP_USER_AGENT'], 'chrome') === false && stripos($_SERVER['HTTP_USER_AGENT'], 'safari') === false))
    <div class="w-100 p-3">
      <p class="p-3 alert-danger">
        <strong>请使用Edge浏览器或Google Chrome浏览器访问本站！否则部分功能将无法使用！</strong>
        <br>
        您可以将本站网址复制下来，输入到浏览器的地址栏中，按回车即可访问。
      </p>
      @if (isset($_SERVER['HTTP_HOST']))
        <p class="p-3 alert-info">
          本站网址 {{ $_SERVER['HTTP_HOST'] }}
        </p>
      @endif
      <p class="p-3 alert-danger">
        如果您还没有安装Edge浏览器或Google Chrome浏览器，请安装！
        <br><br>
        Edge浏览器下载地址
        <a href="https://www.microsoft.com/zh-cn/edge">www.microsoft.com/zh-cn/edge</a>
        <br>
        Google Chrome浏览器下载地址
        <a href="https://www.google.cn/intl/zh-cn/chrome">www.google.cn/intl/zh-cn/chrome</a>
      </p>
    </div>
  @endif

  <nav class="navbar navbar-expand-lg navbar-light bg-white mb-3" style="z-index: 10">

    {{-- 网站名称 --}}
    <a class="navbar-brand text-center" style="min-width: 200px">{{ get_setting('siteName') }}</a>

    {{-- 移动端按钮 --}}
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="navbar-toggler-icon"></span>
    </button>
    @include('layouts.navbar')
  </nav>

  {{-- 除了题目页面外，都要滚动显示公告 --}}
  @if (!in_array(Route::currentRouteName(), ['problem', 'contest.problem']))
    <div class="container">@include('layouts.notice_marquee')</div>
  @endif

  {{-- 主界面 --}}
  <div>
    @yield('content')
  </div>

  {{-- 页脚 --}}
  @include('layouts.footer')

  {{-- 导航栏js控制 --}}
  <script type="text/javascript">
    // 遍历导航栏按钮，如果href与当前位置相等，就active
    $(function() {
      const uri = location.pathname;
      //主导航栏
      $("ul li").find("a").each(function() {
        if ($(this).attr("href").split('?')[0].endsWith(uri)) {
          $(this).addClass("active");
        }
      });
      //特判home
      if (uri === "/") {
        $("#link_home").addClass('active')
      }
      //特判contests
      if (uri.indexOf('/contest') !== -1) {
        // 先特判从group进来的contest
        if (location.search.indexOf('group=') !== -1)
          $('#link_groups').addClass('active')
        else
          $('#link_contests').addClass('active')
      }
      //特判groups(已改名为courses)
      if (uri.indexOf('/course') !== -1) {
        $('#link_groups').addClass('active')
      }
    })
  </script>

</body>

</html>
