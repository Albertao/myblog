@extends('layouts.app')
@section('title')
{{$article->title}}
@endsection
@section('content')

<div class="demo-blog demo-blog--blogpost mdl-layout mdl-js-layout has-drawer is-upgraded">
    <main class="mdl-layout__content">
        <div class="demo-back">
            <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon"
            @if(URL::previous() !== env('CURRENT_HOST').Request::getRequestUri())
                href="{{URL::previous()}}" title="go back"
            @else
                href="{{url('/')}}" title="back to the home page"
            @endif
                role="button">
                <i class="material-icons" role="presentation">arrow_back</i>
            </a>
        </div>
        <div class="demo-blog__posts mdl-grid">
            <div class="mdl-card mdl-shadow--4dp mdl-cell mdl-cell--12-col">
                @if($article->image_url === null)
                <div class="mdl-card__media mdl-color-text--grey-50" style="background-color: #00acc1;">
                    <h3 class="quote">{{$article->title}}</h3>
                </div>
                @else
                <div class="mdl-card__media mdl-color-text--grey-50" style="background-image: url('/{{ $article->image_url }}');">
                    <h3>{{$article->title}}</h3>
                </div>
                @endif
                <div class="mdl-color-text--grey-700 mdl-card__supporting-text meta">
                    <div class="minilogo"></div>
                    <div>
                        <strong>{{$article->author}}</strong>
                        <span>{{$article->updated_at->diffForHumans()}}</span>
                    </div>
                    <div class="section-spacer"></div>
                    <div class="meta__favorites">
                    @foreach($article->categories as $category)
                            <a href="{{URL::route('category', $category->id)}}" class="mdl-button mdl-js-button mdl-js-ripple-effect">
                                {{$category->name}}
                            </a>&nbsp;
                    @endforeach
                    </div>
                    <!--<div class="meta__favorites">
                        <i class="material-icons" role="presentation">favorite</i>
                        <span class="visuallyhidden">favorites</span>
                    </div>
                    <div>
                        <i class="material-icons" role="presentation">bookmark</i>
                        <span class="visuallyhidden">bookmark</span>
                    </div>
                    <div>
                        <i class="material-icons" role="presentation">share</i>
                        <span class="visuallyhidden">share</span>
                    </div>-->
                </div>
                <div style="padding:20px 50px;">
                    <?php echo html_entity_decode($article->content) ?>
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
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="commentLabel">
                            <textarea rows=1 class="mdl-textfield__input" id="comment" name="comment"></textarea>
                            <label for="comment" class="mdl-textfield__label">Join the discussion</label>
                        </div>
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                            <i class="material-icons" role="presentation">check</i><span class="visuallyhidden">add comment</span>
                        </button>
                    </form>
                    @foreach($article->comment->sortByDesc('created_at') as $comment)
                    @if(!$comment->user->trashed())
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
                        @foreach($comment->remarks->sortByDesc('created_at') as $remark)
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
                    @endif
                    @endforeach
                </div>
            </div>

            <nav class="demo-nav mdl-color-text--grey-50 mdl-cell mdl-cell--12-col">
                @if($id != 1)
                <a href="{{URL::route('detail', $id-1)}}" class="demo-nav__button">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900" role="presentation">
                        <i class="material-icons">arrow_back</i>
                    </button>
                    Newer
                </a>
                @endif
                <div class="section-spacer"></div>
                @if($article->max !== true)
                <a href="{{URL::route('detail', $id+1)}}" class="demo-nav__button">
                    Older
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900" role="presentation">
                        <i class="material-icons">arrow_forward</i>
                    </button>
                </a>
                @endif
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
           $('#commentLabel').addClass('is-focused');
       });
    });
</script>
</body>
</html>
@endsection