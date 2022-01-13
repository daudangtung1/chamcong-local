@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<link rel="stylesheet" href="{{ asset('css/atomic.css')}}">
<link rel="stylesheet" href="{{ asset('css/custom-bootstrap4.css')}}">
<!--ico font -->
<link rel="stylesheet" href="{{ asset('lib/icofont.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/lib/jquery.timepicker.min.css')}}">

@endpush

<div class="tk-content">
    <div class="row">
        <div class="col-md-3">
            <form action="{{route('user_overtime_store')}}" method="POST" id="user_overtime_form" autocomplete="off">
                @csrf

                @if (session()->has('error'))
                <div class="alert alert-danger alert-block">
                    {{ session()->get('error') }}
                </div>
                @endif

                @if (session()->has('success'))
                <div class="alert alert-success alert-block">
                    {{ session()->get('success') }}
                </div>
                @endif

                <div class="form-group relative">
                    <label for="date" class="tk-label">Ngày</label>
                    <div class="relative">
                        <input type="date" class="form-control " id="date" name="date" required>
                        <div class="tk-icon">
                            <i class="icofont-calendar"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="checkin" class="tk-label">Giờ Checkin</label>
                    <div class="relative">
                        <input autocomplete="off" class="form-control relative" jt-timepicker="" time="model.time" time-string="model.timeString" default-time="model.options.defaultTime" time-format="model.options.timeFormat" start-time="model.options.startTime" min-time="model.options.minTime" max-time="model.options.maxTime" interval="model.options.interval" dynamic="model.options.dynamic" scrollbar="model.options.scrollbar" dropdown="model.options.dropdown" id="checkin" name="checkin">
                        <!-- <input type="time" class="form-control relative" id="checkin" name="checkin"> -->
                        <div class="tk-icon">
                            <i class="icofont-clock-time"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="checkout" class="tk-label">Giờ Checkout</label>
                    <div class="relative">
                        <input autocomplete="off" class="form-control relative" jt-timepicker="" time="model.time" time-string="model.timeString" default-time="model.options.defaultTime" time-format="model.options.timeFormat" start-time="model.options.startTime" min-time="model.options.minTime" max-time="model.options.maxTime" interval="model.options.interval" dynamic="model.options.dynamic" scrollbar="model.options.scrollbar" dropdown="model.options.dropdown" id="checkout" name="checkout">
                        <!-- <input type="time" class="form-control" id="checkout" name="checkout"> -->
                        <div class="tk-icon">
                            <i class="icofont-clock-time"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="totalTime" class="tk-label">Tổng thời gian (h)</label>
                    <input class="form-control w-95" id="totalTime" name="projectName" disabled required style="padding: 13px 26px;">
                </div>
                <div class="form-group">
                    <label for="project" class="tk-label">Dự án đang làm</label>
                    <textarea class="form-control" id="project" name="projectName" rows="3" required placeholder="Dự án"></textarea>
                </div>

                <div class="form-group">
                    <label for="note" class="tk-label">Ghi chú</label>
                    <textarea class="form-control" id="note" rows="3" name="note" placeholder="Nội dung ghi chú"></textarea>
                </div>
                <button class="btn tk-btn" type="submit">Đăng ký</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')

<script src="{{asset('js/lib/jquery.timepicker.min.js')}}"></script>
<script>
    $("#checkin").timepicker({
        timeFormat: 'H:mm',
        interval: 30,
        minTime: '0',
        maxTime: '23:30',
        // defaultTime: '11',
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

    $("#checkout").timepicker({
        timeFormat: 'H:mm',
        interval: 30,
        minTime: '0',
        maxTime: '23:30',
        // defaultTime: '11',
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        change: () => {
            var checkin = $("input#checkin").val();
            var checkout = $("input#checkout").val();

            var timeStart = new Date("01/01/2007 " + checkin).getTime();
            var timeEnd = new Date("01/01/2007 " + checkout).getTime();

            totalHour = NaN;

            console.log(timeStart, timeEnd);

            if (checkout > checkin) {
                var timeStart = new Date("01/01/2007 " + checkin).getTime();
                var timeEnd = new Date("01/01/2007 " + checkout).getTime();

                var hourDiff = timeEnd - timeStart;

                var totalHour = new Date("01/01/2007 " + hourDiff).getTime();

                if (totalHour > 12) {
                    alert('thoi gian lam ot khong duoc qua 12 tieng!');
                    document.getElementById('checkin').value = "";
                    document.getElementById('checkout').value = "";
                    $('#totalTime').val();
                } else {
                    $('#totalTime').val(totalHour);
                }
            } else {
                alert('Giờ checkout phải lớn hơn giờ checkin!');
                document.getElementById('checkout').value = "";
            }
        },
    });



    // function myFunction() {
    //     var checkin = $("input#checkin").val();
    //     var checkout = $("input#checkout").val();

    //     var timeStart = new Date("01/01/2007 " + checkin).getTime();
    //     var timeEnd = new Date("01/01/2007 " + checkout).getTime();

    //     totalHour = NaN;

    //     console.log(timeStart, timeEnd);

    //     if (checkout > checkin) {
    //         // var timeStart = new Date("01/01/2007 " + checkin).getTime();
    //         // var timeEnd = new Date("01/01/2007 " + checkout).getTime();


    //         // var totalHour = new Date("01/01/2007 " + hourDiff).getTime();
    //         var totalHour = timeEnd - timeStart;



    //         if (totalHour > 12) {
    //             alert('thoi gian lam ot khong duoc qua 12 tieng!');
    //             document.getElementById('checkin').value = "";
    //             document.getElementById('checkout').value = "";
    //             $('#totalTime').val();
    //         } else {
    //             $('#totalTime').val(totalHour);
    //         }
    //     } else {
    //         alert('Giờ checkout phải lớn hơn giờ checkin!');
    //         document.getElementById('checkout').value = "";
    //     }
    // }




    $('input#checkin').timepicker({
        change: (time) => {
            alert();
        },
    });
</script>
@endpush