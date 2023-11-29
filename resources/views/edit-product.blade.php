@extends('layouts.app')

@section('title')
    @parent Редактирование продукта
@endsection

@section('content')
    <div class="main_cover">
        @include('include.message')
        <div class="product_card">
            <div class="product_header">
                <h2 class="product_title">Редактировать {{ $product->name }}</h2>
                <a id="close_prod_mw" href="{{ route('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                        <path d="M22.5 7.5L7.5 22.5" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.5 7.5L22.5 22.5" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
            <div class="product_container">
                <form id="addProductForm" action="{{ route( 'update-product', ['product' => $product]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="product_attribute">
                        <label for="product_article" class="product_label">Артикул</label>
                        <input type="text" id="product_article" class="product_input"
                               name="article" value="{{$product->article}}"/>
                    </div>
                    <div class="product_attribute">
                        <label for="product_name" class="product_label">Название</label>
                        <input type="text" id="product_name" class="product_input" name="name" value="{{$product->name}}"/>
                    </div>
                    <div class="product_attribute">
                        <label for="product_status" class="product_label">Статус</label>
                        <select id="product_status" class="product_input" name="status">
                            <option value="available"
                                    @if($product->status === "available") selected @endif >Доступен</option>
                            <option value="unavailable"
                                    @if($product->status === "unavailable") selected @endif >Недоступен</option>

                        </select>
                    </div>
                    <div class="product_attribute">
                        <h3 class="product_attribute_title">Атрибуты</h3>

                        <div id="inputContainer" class="attribute_block">
                            @if(!empty($product->data))
                                @include('include.add-input')
                            @endif
                        </div>
                        <input type="hidden" name="data" id="jsonData">
                        <a class="product_attribute_add" id="addInput" href="#addInput">+ Добавить атрибут</a>
                        {{--                <button onclick="createBlock()">+ Добавить атрибут</button>--}}
                    </div>
                    <div class="products_add">
                        <button class="products_add_button" type="submit" id="products_add_button_id">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('include.js')
