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

    /* 导航栏菜单项选中时的底部样式 */
    .nav-tabs .active {
      /*border-color: #6599ff !important;*/
      border-bottom: .214rem solid #6599ff !important;
    }

    th {
      /*所有table的表头不换行*/
      white-space: nowrap
    }

    .nav-link {
      /*导航栏菜单项的最小宽度*/
      min-width: 90px !important;
      text-align: center;
    }
  </style>

</head>

<body>
  {{-- 检查微信浏览器，不允许使用微信浏览器 --}}
  @if (stripos($_SERVER['HTTP_USER_AGENT'], 'wechat') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'chrome') === false)
    <div class="w-100 p-3">
      <p class="p-3 alert-danger">
        <strong>请使用Edge浏览器或Google Chrome浏览器访问本站！否则部分功能将无法使用！</strong>
        <br>
        您可以将本站网址复制下来，输入到浏览器的地址栏中，按回车即可访问。
      </p>
      @if (isset($_SERVER['HTTP_HOST']))
        <p class="p-3 alert-info">
          本站网址 <a href="{{ $_SERVER['HTTP_HOST'] }}">{{ $_SERVER['HTTP_HOST'] }}</a>
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

    {{-- 导航栏项 --}}
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="navbar-nav nav-tabs">
        <li class="nav-item">
          <a id="link_home" class="nav-link text-nowrap p-2" href="{{ route('home') }}">
            <i class="fa fa-home" aria-hidden="true">&nbsp;{{ trans('main.Home') }}</i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-nowrap p-2" href="{{ route('status') }}">
            <i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;{{ trans('main.HomeStatus') }}</i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-nowrap p-2" href="{{ route('problems') }}">
            <i class="fa fa-list" aria-hidden="true">&nbsp;{{ trans('main.Problems') }}</i>
          </a>
        </li>
        {{-- <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle text-nowrap p-2" href="#" id="contestDropdown" data-toggle="dropdown">
                   <i class="fa fa-trophy" aria-hidden="true">&nbsp;{{trans('main.Contests')}}</i>
               </a>
               <div class="dropdown-menu" aria-labelledby="contestDropdown">
                   @foreach (config('oj.contestType') as $i => $ctype)
                       <a class="dropdown-item text-nowrap" href="{{route('contests',$ctype)}}">
                           <i class="fa fa-book px-1" aria-hidden="true"></i>
                           {{__('main.'.$ctype)}}
                       </a>
                   @endforeach
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item" href="#">Separated link</a>
               </div>
           </li> --}}
        <li class="nav-item">
          <a class="nav-link text-nowrap p-2" id="link_contests" href="{{ route('contests', '_') }}">
            <i class="fa fa-trophy" aria-hidden="true">&nbsp;{{ trans('main.Contests') }}</i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-nowrap p-2" id="link_groups" href="{{ route('groups') }}">
            <i class="fa fa-users" aria-hidden="true"></i>&nbsp;{{ trans('main.Groups') }}</i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-nowrap p-2" href="{{ route('standings') }}">
            <i class="fa fa-sort-amount-desc" aria-hidden="true">&nbsp;{{ trans('main.Standings') }}</i>
          </a>
        </li>
      </ul>

      {{-- <form class="form-inline">
           <input class="form-control mr-sm-2" type="text" />
           <button class="btn btn-primary my-2 my-sm-0" type="submit">
               Search
           </button>
       </form> --}}

      {{-- 登陆按钮 --}}
      <ul class="navbar-nav ml-auto">
        {{-- 语言切换 --}}
        <li class="nav-item dropdown mr-3">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fa fa-language" aria-hidden="true"></i>
            @php($langs = ['en' => 'English', 'zh-CN' => '简体中文'])
            {{ $langs[request()->cookie('client_language') ?? get_setting('APP_LOCALE', 'en')] }}
            <span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @foreach ($langs as $k => $item)
              <a class="dropdown-item" href="{{ route('change_language', $k) }}">{{ $item }}</a>
            @endforeach
          </div>
        </li>

        <!-- Authentication Links -->
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ trans('main.Login') }}</a>
          </li>
          @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ trans('main.Register') }}</a>
            </li>
          @endif
        @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <i class="fa fa-user" aria-hidden="true"></i>
              {{ Auth::user()->username }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

              <a class="dropdown-item" href="{{ route('user', Auth::user()->username) }}">{{ trans('main.Profile') }}</a>
              <a class="dropdown-item" href="{{ route('password_reset', Auth::user()->username) }}">{{ trans('sentence.Reset Password') }}</a>

              @if (privilege('admin.home'))
                <a class="dropdown-item" href="{{ route('admin.home') }}">{{ trans('main.Administration') }}</a>
              @endif

              <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                {{ __('main.Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        @endguest
      </ul>
      {{-- end of 个人信息按钮 --}}

    </div>
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
      //特判groups
      if (uri.indexOf('/group') !== -1) {
        $('#link_groups').addClass('active')
      }
    })
  </script>

</body>

</html>
