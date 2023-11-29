@extends('layouts.app')

@section('title')
    @parent Главная
@endsection

@section('nav')
    @include('layouts.nav')
@endsection

@section('content')
    <div class="erp_content">
        <div class="erp_header">
            <div class="erp_header_type">
                ПРОДУКТЫ
                @include('include.message')
                <div class="erp_header_line"></div>
            </div>
            <div class="erp_header_user">
                <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Выйти') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                </ul>
            </div>
        </div>
        <div class="products_table_cover">
            <div class="products_table">
                <table class="table_product">

                    <thead>
                        <tr>
                            <th scope="col" class="first_col">АРТИКУЛ</th>
                            <th scope="col">НАЗВАНИЕ</th>
                            <th scope="col">СТАТУС</th>
                            <th scope="col">АТРИБУТЫ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productList as $product)
                                <tr class="prod_row">
                                    <td class="first_col">{{ $product->article }}</td>

                                    <td>
                                        <a class="open_prod" href="{{route('show', $product->id)}}">{{ $product->name }}</a>
                                    </td>

                                    <td>
                                        @if($product->status === 'available')
                                            {{ "Доступен" }}
                                        @else
                                            {{ "Не доступен" }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($product->data))
                                        @foreach(json_decode($product->data, true) as $features => $value)
                                            {{ "$features: $value" }}<br/>
                                        @endforeach
                                        @endif
                                    </td>
                                </tr>
                        @empty
                            {{ __('Нет товаров в базе данных') }}
                        @endforelse
                    </tbody>
                </table>
{{--                {{ $productList->links() }}--}}
            </div>

            <div class="products_add">
                <button class="products_add_button" id="open_add_prod" type="button">Добавить</button>
            </div>
        </div>
        @include('modalwds.add-product-modwds')
    </div>
@endsection
