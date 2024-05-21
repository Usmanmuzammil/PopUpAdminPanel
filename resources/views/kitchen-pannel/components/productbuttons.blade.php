

            <div class="row g-0">
                <div class="col-6">

                    <a href="{{ route('kitchen.home') }}" class="w-100 btn btn-outline-primary {!! Request::is('kitchen') ? 'active' : '' !!}">Home</a>
                </div>
                <div class="col-6">

                    <a href="{{ route('unit.index') }}" class="w-100 btn btn-outline-primary {!! Request::is('unit*') ? 'active' : '' !!}">Complete Orders</a>
                </div>


            </div>
