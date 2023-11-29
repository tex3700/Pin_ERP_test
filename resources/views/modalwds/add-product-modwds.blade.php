

<dialog id="add_prod_mw">
    <div class="product_header">
        <h2 class="product_title">Добавить продукт</h2>
        <a id="close_add_prod" href="{{ route('dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path d="M22.5 7.5L7.5 22.5" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M7.5 7.5L22.5 22.5" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>
    <div class="product_container">
        <form id="addProductForm" action="{{ route( 'store', ['product' => $product]) }}" method="post" enctype="multipart/form-data">
            @csrf
{{--            @if($product->id) @method('PUT') @endif--}}
            <div class="product_attribute">
                <label for="product_article" class="product_label">Артикул</label>
                <input type="text" id="product_article" class="product_input" name="article" />
            </div>
            <div class="product_attribute">
                <label for="product_name" class="product_label">Название</label>
                <input type="text" id="product_name" class="product_input" name="name" />
            </div>
            <div class="product_attribute">
                <label for="product_status" class="product_label">Статус</label>
                <select id="product_status" class="product_input" name="status">
                    <option value="available">Доступен</option>
                    <option value="unavailable">Недоступен</option>
                </select>
            </div>
            <div class="product_attribute">
                <h3 class="product_attribute_title">Атрибуты</h3>
                <div id="inputContainer" class="attribute_block"></div>
                <input type="hidden" name="data" id="jsonData">
                <a class="product_attribute_add" id="addInput" href="#addInput">+ Добавить атрибут</a>
{{--                <button onclick="createBlock()">+ Добавить атрибут</button>--}}
            </div>
            <div class="products_add">
                <button class="products_add_button" type="submit" id="products_add_button_id">Добавить</button>
            </div>
        </form>
    </div>
</dialog>
@include('include.js')
