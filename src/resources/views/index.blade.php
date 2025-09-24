
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
        <div class="todo__alert">
            @if(session('message'))
            <div class="todo__alert--success">
            {{ session('message') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="todo__alert--danger">
                <ul class="todo__alert--danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="todo__content">
            <div class="section__title">
            <h2>新規作成</h2>
            </div>
            <form class="create__form" action="/todos" method="post">
            @csrf
                <div class="create__form__item">
                    <input class="create__form__item__input" type="text" name="content" value="{{ old('content') }}">
                    <select class="create__form__item__select">
                        <option value="">カテゴリ</option>
                    </select>
                </div>
                <div class="create__form__button">
                    <button class="create__form__button__submit" type="submit">作成</button>
                </div>
            </form>
            <div class="section__title">
            <h2>Todo検索</h2>
            </div>
            <form class="search__form">
            @csrf
                <div class="search__form__item">
                    <input class="search__form__item__input" type="text">
                    <select class="search__form__item__select">
                        <option value="">カテゴリ</option>
                    </select>
                </div>
                <div class="search__form__button">
                    <button class="search__form__button__submit" type="submit">検索</button>
                </div>
            </form>

            <div class="todo__table">
                <table class="todo__table__inner">
                    <tr class="todo__table__row">
                        <th class="todo-table__header">
                        <span class="todo-table__header-span">Todo</span>
                        <span class="todo-table__header-span">カテゴリ</span>
                        </th>
                    </tr>
                    @foreach ($todos as $todo)
                    <tr class="todo__table__row">
                        <td class="todo__table__item">
                        <form class="update__form" action="/todos/update" method="POST">
                            @method('PATCH')
                            @csrf
                                <div class="update__form__item">
                                    <input class="update___form__item__input" type="text" name="content" value="{{ $todo['content'] }}">
                                    <input type="hidden" name="id" value="{{ $todo['id'] }}">
                                </div>
                                <div class="update__form__item">
                                    <p class="update__form__item-p">Category 1</p>
                                </div>
                                <div class="update__form__button">
                                    <button class="update__form__button__submit" type="submit">更新</button>
                                </div>
                            </form>
                        </td>
                        <td class="todo__table__item">
                            <form class="delete__form" action="/todos/delete" method="post">
                                @method('delete')
                                @csrf
                                <div class="delete__form__button">
                                    <input type="hidden" name="id" value="{{ $todo['id'] }}">
                                    <button class="delete__form__button__submit" type="submit">削除</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
@endsection
