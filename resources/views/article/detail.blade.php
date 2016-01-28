@extends('layouts.app')
@section('title')
{{$article->title}}
@endsection
@section('content')

@endsection




<div class="demo-blog demo-blog--blogpost mdl-layout mdl-js-layout has-drawer is-upgraded">
    <main class="mdl-layout__content">
        <div class="demo-back">
            <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" href="{{ URL::previous() }}" title="go back" role="button">
                <i class="material-icons" role="presentation">arrow_back</i>
            </a>
        </div>
        <div class="demo-blog__posts mdl-grid">
            <div class="mdl-card mdl-shadow--4dp mdl-cell mdl-cell--12-col">
                <div class="mdl-card__media mdl-color-text--grey-50">
                    <h3>{{$article->title}}</h3>
                </div>
                <div class="mdl-color-text--grey-700 mdl-card__supporting-text meta">
                    <div class="minilogo"></div>
                    <div>
                        <strong>{{$article->title}}</strong>
                        <span>{{$article->updated_at->diffForHumans()}}</span>
                    </div>
                    <div class="section-spacer"></div>
                    <div class="meta__favorites">
                        425 <i class="material-icons" role="presentation">favorite</i>
                        <span class="visuallyhidden">favorites</span>
                    </div>
                    <div>
                        <i class="material-icons" role="presentation">bookmark</i>
                        <span class="visuallyhidden">bookmark</span>
                    </div>
                    <div>
                        <i class="material-icons" role="presentation">share</i>
                        <span class="visuallyhidden">share</span>
                    </div>
                </div>
                <div class="mdl-color-text--grey-700 mdl-card__supporting-text">
                    {{$article->content}}
                </div>
                <div class="mdl-color-text--primary-contrast mdl-card__supporting-text comments">
                    @if(Session::has('error'))
                        <h3 class="mdl-color-text--red">{{Session::get('error')}}, click <a href="{{url('/login')}}">here</a> to login</h3>
                    @elseif(Session::has('success'))
                        <h3 class="mdl-color-text--blue">{{Session::get('success')}}</h3>
                    @endif

                    <form action="{{URL::route('comment')}}" id="postComment" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="articleId" value="{{$id}}">
                        <input type="hidden" name="parent_id" id="comment_parent" value="0">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <textarea rows=1 class="mdl-textfield__input" id="comment" name="comment"></textarea>
                            <label for="comment" class="mdl-textfield__label">Join the discussion</label>
                        </div>
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                            <i class="material-icons" role="presentation">check</i><span class="visuallyhidden">add comment</span>
                        </button>
                    </form>
                    @foreach($article->comment as $comment)
                    @if($comment->parent_id == 0)
                    <div class="comment mdl-color-text--grey-700">
                        <header class="comment__header">
                            <img src="/{{$comment->user->head_url}}" class="comment__avatar">
                            <div class="comment__author">
                                <strong>{{$comment->user->name}}</strong>
                                <span>{{$comment->created_at->diffForHumans()}}</span>
                            </div>
                        </header>
                        <div class="comment__text">
                            {{$comment->content}}
                        </div>
                        <nav class="comment__actions">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                <i class="material-icons" role="presentation">thumb_up</i><span class="visuallyhidden">like comment</span>
                            </button>
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                <i class="material-icons" role="presentation">thumb_down</i><span class="visuallyhidden">dislike comment</span>
                            </button>
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon commentButton" data-id="{{$comment->id}}" data-author="{{$comment->user->name}}">
                                <i class="material-icons" role="presentation">comment</i><span class="visuallyhidden">re comment</span>
                            </button>
                        </nav>
                        @foreach($comment->remarks as $remark)
                            <div class="comment__answers">
                                <div class="comment">
                                    <header class="comment__header">
                                        <img src="/{{$remark->user->head_url}}" class="comment__avatar">
                                        <div class="comment__author">
                                            <strong>{{$remark->user->name}}</strong>
                                            <span>{{$remark->created_at->diffForHumans()}}</span>
                                        </div>
                                    </header>
                                    <div class="comment__text">
                                        {{$remark->content}}
                                    </div>
                                    <nav class="comment__actions">
                                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                            <i class="material-icons" role="presentation">thumb_up</i><span class="visuallyhidden">like comment</span>
                                        </button>
                                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                            <i class="material-icons" role="presentation">thumb_down</i><span class="visuallyhidden">dislike comment</span>
                                        </button>
                                    </nav>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                    @endforeach

                    <!--<div class="comment mdl-color-text--grey-700">
                        <header class="comment__header">
                            <img src="images/co1.jpg" class="comment__avatar">
                            <div class="comment__author">
                                <strong>James Splayd</strong>
                                <span>2 days ago</span>
                            </div>
                        </header>
                        <div class="comment__text">
                            In in culpa nulla elit esse. Ex cillum enim aliquip sit sit ullamco ex eiusmod fugiat. Cupidatat ad minim officia mollit laborum magna dolor tempor cupidatat mollit. Est velit sit ad aliqua ullamco laborum excepteur dolore proident incididunt in labore elit.
                        </div>
                        <nav class="comment__actions">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                <i class="material-icons" role="presentation">thumb_up</i><span class="visuallyhidden">like comment</span>
                            </button>
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                <i class="material-icons" role="presentation">thumb_down</i><span class="visuallyhidden">dislike comment</span>
                            </button>
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                <i class="material-icons" role="presentation">share</i><span class="visuallyhidden">share comment</span>
                            </button>
                        </nav>
                        <div class="comment__answers">
                            <div class="comment">
                                <header class="comment__header">
                                    <img src="images/co2.jpg" class="comment__avatar">
                                    <div class="comment__author">
                                        <strong>John Dufry</strong>
                                        <span>2 days ago</span>
                                    </div>
                                </header>
                                <div class="comment__text">
                                    Yep, agree!
                                </div>
                                <nav class="comment__actions">
                                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                        <i class="material-icons" role="presentation">thumb_up</i><span class="visuallyhidden">like comment</span>
                                    </button>
                                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                        <i class="material-icons" role="presentation">thumb_down</i><span class="visuallyhidden">dislike comment</span>
                                    </button>
                                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                        <i class="material-icons" role="presentation">share</i><span class="visuallyhidden">share comment</span>
                                    </button>
                                </nav>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>

            <nav class="demo-nav mdl-color-text--grey-50 mdl-cell mdl-cell--12-col">
                <a href="index.html" class="demo-nav__button">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900" role="presentation">
                        <i class="material-icons">arrow_back</i>
                    </button>
                    Newer
                </a>
                <div class="section-spacer"></div>
                <a href="index.html" class="demo-nav__button">
                    Older
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900" role="presentation">
                        <i class="material-icons">arrow_forward</i>
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
<a href="https://github.com/google/material-design-lite/blob/master/templates/blog/" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">View Source</a>
<script src="{{URL::asset('asset/js/material.min.js')}}"></script>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    $(function(){
       $('.commentButton').click(function(){
           $('#comment_parent').val($(this).data('id'));
           $('#comment').val('R.E. @'+$(this).data('author')+': ');
       });
    });
</script>
</body>
</html>