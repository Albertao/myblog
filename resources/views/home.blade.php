@extends('layouts.app')
<div class="demo-blog mdl-layout mdl-js-layout has-drawer is-upgraded">
    <main class="mdl-layout__content">
        <div class="demo-blog__posts mdl-grid">
            <div class="mdl-card coffee-pic mdl-cell mdl-cell--8-col">
                <div class="mdl-card__media mdl-color-text--grey-50" style="background-image: url('{{URL::asset('/asset/img/articles/'.$first->image_url)}}');">
                    <h3><a href="entry.html">{{$first->title}}</a></h3>
                </div>
                <div class="mdl-card__supporting-text meta mdl-color-text--grey-600">
                    <div class="minilogo"></div>
                    <div>
                        <strong>{{$first->author}}</strong>
                        <span>{{$first->updated_at->diffForHumans()}}</span>
                    </div>
                </div>
            </div>
            <div class="mdl-card something-else mdl-cell mdl-cell--8-col mdl-cell--4-col-desktop">
                @if(Auth::guest())
                <button class="mdl-button mdl-js-ripple-effect mdl-js-button mdl-button--fab mdl-color--grey" onclick="window.location.href='{{url('/login')}}'" title="click to login">
                    <i class="material-icons mdl-color-text--white" role="presentation">done</i>
                    <span class="visuallyhidden">sign in</span>
                </button>
                <div style="background-image: url('{{URL::asset('asset/img/tapet_2016-01-05_15-13-15_538_2880x2560.png2')}}');" class="mdl-card__media mdl-color--white mdl-color-text--grey-600">
                </div>
                <div class="mdl-card__supporting-text meta meta--fill mdl-color-text--grey-600">
                    <div>
                        <strong>Welcome to my blog~!</strong>
                    </div>
                    <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right mdl-js-ripple-effect" for="menubtn">
                        <a style="text-decoration: none;" href="{{URL::route('about')}}"><li class="mdl-menu__item">About</li></a>
                        <a style="text-decoration: none;" target="_blank" href="http://weibo.com/u/1864452734"><li class="mdl-menu__item">Sina Weibo</li></a>
                        <a style="text-decoration: none;" target="_blank" href="https://github.com/Albertao"><li class="mdl-menu__item">Github</li></a>
                    </ul>
                    <button id="menubtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                        <i class="material-icons" role="presentation">more_vert</i>
                        <span class="visuallyhidden">show menu</span>
                    </button>
                </div>
                @else
                <button class="mdl-button mdl-js-ripple-effect mdl-js-button mdl-button--fab mdl-color--grey" onclick="window.location.href='{{URL::route('edit')}}'" title="click to edit your profile">
                    <i class="material-icons mdl-color-text--white" role="presentation">edit</i>
                    <span class="visuallyhidden">edit</span>
                </button>
                <div class="mdl-card__media mdl-color--blue-grey mdl-color-text--grey-600">
                    <img src="{{Auth::user()->head_url}}">
                    {{Auth::user()->name}}
                </div>
                <div class="mdl-card__supporting-text meta meta--fill mdl-color-text--grey-600">
                    <div>
                        <strong>Welcome back,{{Auth::user()->name}}~!</strong>
                    </div>
                    <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right mdl-js-ripple-effect" for="menubtn">
                        <a style="text-decoration: none;" href="{{URL::route('about')}}"><li class="mdl-menu__item">About</li></a>
                        <a style="text-decoration: none;" href="{{URL::route('edit')}}"><li class="mdl-menu__item">Edit profile</li></a>
                        <a style="text-decoration: none;" href="{{url('/logout')}}"><li class="mdl-menu__item">Logout</li></a>
                    </ul>
                    <button id="menubtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                        <i class="material-icons" role="presentation">more_vert</i>
                        <span class="visuallyhidden">show menu</span>
                    </button>
                </div>
                @endif
            </div>
            @foreach($others as $other)
                @if($other->image_url === null)
                <div class="mdl-card amazing mdl-cell mdl-cell--12-col">
                    <div class="mdl-card__title mdl-color-text--grey-50">
                        <h3 class="quote"><a href="{{URL::route('detail', $other->id)}}">{{$other->slag}}</a></h3>
                    </div>
                    <div class="mdl-card__supporting-text meta mdl-color-text--grey-600">
                        <div class="minilogo"></div>
                        <div>
                            <strong>{{$other->author}}</strong>
                            <span>{{$other->updated_at->diffForHumans()}}</span>
                        </div>
                    </div>
                </div>
                @else
                <div class="mdl-card on-the-road-again mdl-cell mdl-cell--12-col">
                    <div class="mdl-card__media mdl-color-text--grey-50" style="background-image: url('{{URL::asset('/asset/img/tapet_2016-01-09_12-25-18_053_2880x2560.png')}}');">
                        <h3><a href="{{URL::route('detail', $other->id)}}">{{$other->title}}</a></h3>
                    </div>
                    <div class="mdl-color-text--grey-600 mdl-card__supporting-text">
                        {{$other->slag}}
                    </div>
                    <div class="mdl-card__supporting-text meta mdl-color-text--grey-600">
                        <div class="minilogo"></div>
                        <div>
                            <strong>{{$other->author}}</strong>
                            <span>{{$other->updated_at->diffForHumans()}}</span>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach`
            <nav class="demo-nav mdl-cell mdl-cell--12-col">
                <div class="section-spacer"></div>
                <a href="entry.html" class="demo-nav__button" title="show more">
                    More
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                        <i class="material-icons" role="presentation">arrow_forward</i>
                    </button>
                </a>
            </nav>
        </div>
        <footer class="mdl-mini-footer">
            <div class="mdl-mini-footer--left-section">
                <button class="mdl-mini-footer--social-btn social-btn social-btn__twitter">
                    <span class="visuallyhidden">Twitter</span>
                </button>
                <button class="mdl-mini-footer--social-btn social-btn social-btn__blogger">
                    <span class="visuallyhidden">Facebook</span>
                </button>
                <button class="mdl-mini-footer--social-btn social-btn social-btn__gplus">
                    <span class="visuallyhidden">Google Plus</span>
                </button>
            </div>
            <div class="mdl-mini-footer--right-section">
                <button class="mdl-mini-footer--social-btn social-btn__share">
                    <i class="material-icons" role="presentation">share</i>
                    <span class="visuallyhidden">share</span>
                </button>
            </div>
        </footer>
    </main>
    <div class="mdl-layout__obfuscator"></div>
</div>
<a href="https://github.com/Albertao/myblog" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">View Source</a>
<script src="{{URL::asset('asset/js/material.min.js')}}"></script>
</body>
<script>
    Array.prototype.forEach.call(document.querySelectorAll('.mdl-card__media'), function(el) {
        var link = el.querySelector('a');
        if(!link) {
            return;
        }
        var target = link.getAttribute('href');
        if(!target) {
            return;
        }
        el.addEventListener('click', function() {
            location.href = target;
        });
    });
</script>
</html>