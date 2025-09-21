
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
        <div class="todo__created__content">
            @if(session('message'))
            <div class="todo__created__item">
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

        <div class="main__todo__content">
            <form class="create__form" action="/todos" method="post">
            @csrf
                <div class="main__text__item">
                    <input class="main__text__item__input" type="text" name="content">
                </div>
                <div class="todo__button">
                    <button class="todo__button__submit" type="submit">作成</button>
                </div>
            </form>
            <div class="todo__table">
                <table class="todo__table__inner">
                    <tr class="todo__table__row">
                        <th class="todo__table__header">Todo</th>
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
