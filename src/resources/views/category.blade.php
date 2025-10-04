
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
        <div class="category__alert">
            @if(session('message'))
            <div class="category__alert--success">
            {{ session('message') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="category__alert--danger">
                <ul class="category__alert--danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="category__content">
            <form class="create__form" action="/categories" method="post">
            @csrf
                <div class="create__form__item">
                    <input class="create__form__item__input" type="text" name="name" value="{{ old('name') }}">
                </div>
                <div class="create__form__button">
                    <button class="create__form__button__submit" type="submit">作成</button>
                </div>
            </form>

            <div class="category__table">
                <table class="category__table__inner">
                    <tr class="category__table__row">
                        <th class="category__table__header">category</th>
                    </tr>
                    @foreach ($categories as $category)
                    <tr class="category__table__row">
                        <td class="category__table__item">
                        <form class="update__form" action="/categories/update" method="post">
                            @method('PATCH')
                            @csrf
                                <div class="update__form__item">
                                    <input class="update___form__item__input" type="text" name='name' value="{{ $category['name'] }}">
                                    <input type="hidden" name="id" value="{{ $category['id'] }}">
                                </div>
                                <div class="update__form__button">
                                    <button class="update__form__button__submit" type="submit">更新</button>
                                </div>
                            </form>
                        </td>
                        <td class="category__table__item">
                            <form class="delete__form" action="/categories/delete" method="post">
                                @method('DELETE')
                                @csrf
                                <div class="delete__form__button">
                                    <input type="hidden" name="id" value="{{ $category['id'] }}">
                                    <button class="delete__form__button__submit" type="submit">削除</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
                <div class="paginate">
                    {{ $categories->links() }}
                </div>
        </div>
@endsection
