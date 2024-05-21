
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center ">
            <a href="{{ route('unit.index') }}" class=" btn btn-outline-primary {!! Request::is('unit*') ? 'active' : '' !!}">Unit</a>
            <a href="{{ url('/category') }}" class="btn btn-outline-primary  {!! Request::is('category*') ? 'active' : '' !!}" data-key="t-ecommerce">  Category
            </a>
            <a href="{{ url('/addons') }}" class="btn btn-outline-primary  {!! Request::is('addons*') ? 'active' : '' !!}" data-key="t-ecommerce">  Addons
            </a>
            <a href="{{ url('/attribute') }}" class="btn btn-outline-primary  {!! Request::is('attribute*') ? 'active' : '' !!}" data-key="t-ecommerce">  Attribute
            </a>
            <a href="{{ url('/product') }}" class="btn btn-outline-primary  {!! Request::is('product*') ? 'active' : '' !!}" data-key="t-ecommerce">  Product
            </a>

        </div>
    </div>
  </div>
