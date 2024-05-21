<!-- Menubar -->
<div class="menubar-area footer-fixed rounded-0 border-top ">
    <div class="toolbar-inner menubar-nav" style="width: 100%!important">
        <a style="width: 100%!important" href="{{ route('order-booker.dashboard') }}" class="nav-link {!! Request::is('order-bookers') ? 'active' : '' !!}">
            <i class="icon feather icon-home"></i>
            <span class="link-name">Home</span>
        </a>
        <a style="width: 100%!important" href="{{ route('order-booker.order.index') }}" class="nav-link {!! Request::is('order-bookers/my-orders') ? 'active' : '' !!}">
            <i class="icon feather icon-grid"></i>
            <small class="badge bg-primary border-rounded position-absolute top-0 mt-1" id="footer_total_orders">0</small>
            <span class="link-name">Orders</span>

        </a>

        <a style="width: 100%!important" href="{{ route('order-booker.delevered.order') }}" class="nav-link {!! Request::is('order-bookers/delevered-orders') ? 'active' : '' !!}">
            <i class="icon feather icon-grid"></i>
            <small class="badge bg-primary border-rounded position-absolute top-0 mt-1" id="footer_total_complete_orders">0</small>

            <span class="link-name">Complete Orders</span>
        </a>
        {{-- <a href="{{ route('order-booker.order.report') }}" class="nav-link {!! Request::is('order-bookers/order/reports') ? 'active' : '' !!}">
            <i class="icon feather icon-book"></i>
            <span>Reports</span>
        </a> --}}

    </div>
</div>

@push('script')

<script>
    $(document).ready(function () {
        $('.nav-link').on('click', function () {
            var linkText = $(this).text();
            var linkElement = $(this);

            $('.nav-link').find('.spinner-border').removeClass('spinner-border border-sm text-primary');

            // Hide the link text and show the spinner
            linkElement.addClass('d-flex align-items-center justify-content-center');
            linkElement.html('<span class="spinner-border border-sm text-primary"></span>');

            // Store the original link text in a data attribute
            linkElement.data('originalText', linkText);

            // Simulate a delay (5 seconds) - you can adjust this value
            setTimeout(function () {
                // After the delay, hide the spinner and restore the link text
                linkElement.removeClass('d-flex align-items-center justify-content-center');
                linkElement.closest('.spinner-border').hide();
                linkElement.text(linkElement.data('originalText'));
            }, 5000);
        });
    });
</script>
@endpush
