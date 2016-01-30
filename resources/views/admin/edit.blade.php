@extends('layouts.admin')
@section('location')
    Article Edit
@endsection
@section('content')
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="demo-content mdl-grid">
        <div class="mdl-cell--12-col">
            <form action="{{URL::route('admin::article::post')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="mdl-textfield mdl-js-textfield" style="width: 100%; color: #3f51b5;">
                    <input class="mdl-textfield__input" type="text" id="title" name="title">
                    <label class="mdl-textfield__label" for="title">Article title here……</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield" style="width: 100%; color: #3f51b5;">
                    <input class="mdl-textfield__input" type="text" id="title" name="title">
                    <label class="mdl-textfield__label" for="title">Article slag here……</label>
                </div>
            </form>
            <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-cell--12-col">
                <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Material</th>
                    <th>Quantity</th>
                    <th>Unit price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">{{$category->name}}</td>
                    <td>25</td>
                    <td>$2.90</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection