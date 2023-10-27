@extends('layouts.admin')

@section('page-title')
{{ __('Dashboard') }}
@endsection

@php
$setting = App\Models\Utility::settings();

@endphp

{{-- @section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
@endsection --}}

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif


@if (\Auth::user()->type == 'employee')
<!-- <div class="col-xxl-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <h5>{{ __('Calendar') }}</h5>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for=""></label>
                                @if (isset($setting['is_enabled']) && $setting['is_enabled'] == 'on')
                                    <select class="form-control" name="calender_type" id="calender_type"
                                        onchange="get_data()">
                                        <option value="google_calender">{{ __('Google Calender') }}</option>
                                        <option value="local_calender" selected="true">
                                            {{ __('Local Calender') }}</option>
                                    </select>
                                @endif
                                <input type="hidden" id="path_admin" value="{{ url('/') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id='event_calendar' class='calendar'></div>
                </div>
            </div>
        </div> -->
<div class="col-xxl-6">

    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_7AU1pVekCxM9B_sYj1e2gM8mcqdMs94"></script> -->
    <div class="card" style="height: auto;">
        <div class="card-header">
            <h5>{{ __('Mark Attandance') }}</h5>
        </div>
        <div class="card-body">
            <p class="text-muted pb-0-5">
                {{ __('My Office Time: ' . $officeTime['startTime'] . ' to ' . $officeTime['endTime']) }}
            </p>
            <div class="row">
                <div class="col-md-6">
                    {{ Form::open(['url' => 'attendanceemployee/attendance', 'method' => 'post']) }}
                    @if (empty($employeeAttendance) || $employeeAttendance->clock_out != '00:00:00')
                    <!-- Tambahkan elemen div untuk menampilkan peta -->
                    <div id="map" style="width: 100%; height: 200px;"></div>


                    <input type="text" name="latitude" id="latitude" value="Teks yang tidak dapat diubah" readonly>
                    <input type="text" name="longitude" id="longitude" value="Teks yang tidak dapat diubah" readonly>
                </div>

                <div class="col-md-6 mt-3 text-right" style="text-align: right;">
                    <button type="submit" value="0" name="in" id="clock_in"
                        class="btn btn-primary">{{ __('CLOCK IN') }}</button>
                    @else
                    <button type="submit" value="0" name="in" id="clock_in" class="btn btn-primary disabled"
                        disabled>{{ __('CLOCK IN') }}</button>
                    @endif
                    {{ Form::close() }}
                    @if (!empty($employeeAttendance) && $employeeAttendance->clock_out == '00:00:00')
                    {{ Form::model($employeeAttendance, ['route' => ['attendanceemployee.update', $employeeAttendance->id], 'method' => 'PUT']) }}
                    <button type="submit" value="1" name="out" id="clock_out"
                        class="btn btn-danger">{{ __('CLOCK OUT') }}</button>
                    @else
                    <button type="submit" value="1" name="out" id="clock_out" class="btn btn-danger disabled"
                        disabled>{{ __('CLOCK OUT') }}</button>
                    @endif
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="card" style="height: 462px;">
                <div class="card-header card-body table-border-style">
                    <h5>{{ __('Meeting schedule') }}</h5>
                </div>
                <div class="card-body" style="height: 320px">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Meeting title') }}</th>
                                    <th>{{ __('Meeting Date') }}</th>
                                    <th>{{ __('Meeting Time') }}</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($meetings as $meeting)
                                    <tr>
                                        <td>{{ $meeting->title }}</td>
                                        <td>{{ \Auth::user()->dateFormat($meeting->date) }}</td>
                                        <td>{{ \Auth::user()->timeFormat($meeting->time) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <h5>{{ __('Announcement List') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Start Date') }}</th>
                                    <th>{{ __('End Date') }}</th>
                                    <th>{{ __('Description') }}</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($announcements as $announcement)
                                    <tr>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ \Auth::user()->dateFormat($announcement->start_date) }}</td>
                                        <td>{{ \Auth::user()->dateFormat($announcement->end_date) }}</td>
                                        <td>{{ $announcement->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
</div>
@else
<div class="col-xxl-12">

    {{-- start --}}
    <div class="row">

        <div class="col-lg-4 col-md-6">

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-users"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted">{{ __('Total') }}</small>
                                    <h6 class="m-0">{{ __('Staff') }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0 text-primary">{{ $countUser + $countEmployee }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-info">
                                    <i class="ti ti-ticket"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted">{{ __('Total') }}</small>
                                    <h6 class="m-0">{{ __('Ticket') }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0 text-info"> {{ $countTicket }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-warning">
                                    <i class="ti ti-wallet"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted">{{ __('Total') }}</small>
                                    <h6 class="m-0">{{ __('Account Balance') }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0 text-warning">{{ \Auth::user()->priceFormat($accountBalance) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-lg-4 col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mb-3 mb-sm-0">
                    <div class="d-flex align-items-center">
                        <div class="theme-avtar bg-primary">
                            <i class="ti ti-cast"></i>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted">{{ __('Total') }}</small>
                            <h6 class="m-0">{{ __('Jobs') }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-auto text-end">
                    <h4 class="m-0 text-primary">{{ $activeJob + $inActiveJOb }}</h4>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="col-lg-4 col-md-6">

    <div class="card">
        <div class="card-body">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mb-3 mb-sm-0">
                    <div class="d-flex align-items-center">
                        <div class="theme-avtar bg-info">
                            <i class="ti ti-cast"></i>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted">{{ __('Total') }}</small>
                            <h6 class="m-0">{{ __('Active Jobs') }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-auto text-end">
                    <h4 class="m-0 text-info"> {{ $activeJob }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-6">

    <div class="card">
        <div class="card-body">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mb-3 mb-sm-0">
                    <div class="d-flex align-items-center">
                        <div class="theme-avtar bg-warning">
                            <i class="ti ti-cast"></i>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted">{{ __('Total') }}</small>
                            <h6 class="m-0">{{ __('Inactive Jobs') }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-auto text-end">
                    <h4 class="m-0 text-warning">{{ $inActiveJOb }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- </div> --}}

{{-- end --}}

<div class="col-xxl-12">
    <div class="row">
        <div class="col-xl-5">

            <div class="card">
                <div class="card-header card-body table-border-style">
                    <h5>{{ __('Meeting schedule') }}</h5>
                </div>
                <div class="card-body" style="height: 324px; overflow:auto">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Time') }}</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($meetings as $meeting)
                                <tr>
                                    <td>{{ $meeting->title }}</td>
                                    <td>{{ \Auth::user()->dateFormat($meeting->date) }}</td>
                                    <td>{{ \Auth::user()->timeFormat($meeting->time) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header card-body table-border-style">
                    <h5>{{ __("Today's Not Clock In") }}</h5>
                </div>
                <div class="card-body" style="height: 324px; overflow:auto">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($notClockIns as $notClockIn)
                                <tr>
                                    <td>{{ $notClockIn->name }}</td>
                                    <td><span class="absent-btn">{{ __('Absent') }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <h5>{{ __('Calendar') }}</h5>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for=""></label>
                                @if (isset($setting['is_enabled']) && $setting['is_enabled'] == 'on')
                                <select class="form-control" name="calender_type" id="calender_type"
                                    onchange="get_data()">
                                    <option value="google_calender">{{ __('Google Calender') }}</option>
                                    <option value="local_calender" selected="true">
                                        {{ __('Local Calender') }}</option>
                                </select>
                                @endif
                                <input type="hidden" id="path_admin" value="{{ url('/') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body card-635">
                    <div id='calendar' class='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-12 col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-body table-border-style">
            <h5>{{ __('Announcement List') }}</h5>
        </div>
        <div class="card-body" style="height: 270px; overflow:auto">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                            <th>{{ __('Description') }}</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($announcements as $announcement)
                        <tr>
                            <td>{{ $announcement->title }}</td>
                            <td>{{ \Auth::user()->dateFormat($announcement->start_date) }}</td>
                            <td>{{ \Auth::user()->dateFormat($announcement->end_date) }}</td>
                            <td>{{ $announcement->description }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
@endif
@endsection
{{-- {{ dd($arrEvents) }} --}}



@push('script-page')
<script src="{{ asset('assets/js/plugins/main.min.js') }}"></script>

@if (Auth::user()->type == 'company' || Auth::user()->type == 'hr')
<script type="text/javascript">
$(document).ready(function() {
    get_data();
});

function get_data() {
    var calender_type = $('#calender_type :selected').val();
    console.log(calender_type);
    $('#calendar').removeClass('local_calender');
    $('#calendar').removeClass('google_calender');
    if (calender_type == undefined) {
        calender_type = 'local_calender';
    }
    $('#calendar').addClass(calender_type);

    $.ajax({
        url: $("#path_admin").val() + "/event/get_event_data",
        method: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            'calender_type': calender_type
        },
        success: function(data) {
            (function() {
                var etitle;
                var etype;
                var etypeclass;
                var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    buttonText: {
                        timeGridDay: "{{ __('Day') }}",
                        timeGridWeek: "{{ __('Week') }}",
                        dayGridMonth: "{{ __('Month') }}"
                    },
                    themeSystem: 'bootstrap',
                    slotDuration: '00:10:00',
                    navLinks: true,
                    droppable: true,
                    selectable: true,
                    selectMirror: true,
                    editable: true,
                    dayMaxEvents: true,
                    handleWindowResize: true,
                    events: data,
                });
                calendar.render();
            })();
        }
    });

}
</script>
@else
<script>
$(document).ready(function() {
    get_data();
});

function get_data() {
    var calender_type = $('#calender_type :selected').val();
    console.log(calender_type);
    $('#event_calendar').removeClass('local_calender');
    $('#event_calendar').removeClass('google_calender');
    if (calender_type == undefined) {
        calender_type = 'local_calender';
    }
    $('#event_calendar').addClass(calender_type);

    $.ajax({
        url: $("#path_admin").val() + "/event/get_event_data",
        method: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            'calender_type': calender_type
        },
        success: function(data) {
            (function() {
                var etitle;
                var etype;
                var etypeclass;
                var calendar = new FullCalendar.Calendar(document.getElementById(
                    'event_calendar'), {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    buttonText: {
                        timeGridDay: "{{ __('Day') }}",
                        timeGridWeek: "{{ __('Week') }}",
                        dayGridMonth: "{{ __('Month') }}"
                    },
                    themeSystem: 'bootstrap',
                    slotDuration: '00:10:00',
                    navLinks: true,
                    droppable: true,
                    selectable: true,
                    selectMirror: true,
                    editable: true,
                    dayMaxEvents: true,
                    handleWindowResize: true,
                    events: data,
                });
                calendar.render();
            })();
        }
    });

}
</script>
<script>
var initialLatitude = -6.930560; // Koordinat awal latitude disesuaikan dengan kantor
var initialLongitude = 110.273308; // Koordinat awal longitude disesuaikan dengan kantor
var maxDistance = 50; // Maksimum jarak dalam meter

window.addEventListener("load", getLocation); // Panggil getLocation saat halaman dimuat

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        document.getElementById("latitude").value = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    // Perbarui kolom masukan dengan garis lintang dan garis bujur
    document.getElementById("latitude").value = latitude;
    document.getElementById("longitude").value = longitude;

    // Periksa jarak dari koordinat awal
    var clock_in = document.getElementById("clock_in");

    // Menambahkan event listener untuk mengaktifkan tombol saat di-klik
    clock_in.addEventListener("click", function() {
        // Kode logika atau tindakan lain yang ingin Anda lakukan saat tombol diklik
    });

    var distance = calculateDistance(initialLatitude, initialLongitude, latitude, longitude);
    if (distance > maxDistance) {

        alert("Posisi Anda terlalu jauh dari koordinat awal. Data tidak akan tersimpan.");
        clock_in.disabled = true;
    } else {
        sendData(latitude, longitude);
    }
}

function calculateDistance(lat1, lon1, lat2, lon2) {
    // Rumus Haversine untuk menghitung jarak antara dua koordinat
    var R = 6371e3; // Earth's radius in meters
    var φ1 = (lat1 * Math.PI) / 180;
    var φ2 = (lat2 * Math.PI) / 180;
    var Δφ = ((lat2 - lat1) * Math.PI) / 180;
    var Δλ = ((lon2 - lon1) * Math.PI) / 180;

    var a =
        Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
        Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var distance = R * c;

    return distance;
}

function sendData(latitude, longitude) {
    // Sekarang Anda dapat mengirimkan garis lintang dan bujur ke backend PHP Anda menggunakan AJAX atau metode lainnya
    // For example:
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "process_coordinates.php", true); // Ganti "process_coordinates.php" dengan URL yang sesuai
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    var data = "latitude=" + latitude + "&longitude=" + longitude;
    xhr.send(data);
}
</script>
<!-- <script async defer
    src="https://www.google.com/maps/embed/v1/view?key=AIzaSyD_7AU1pVekCxM9B_sYj1e2gM8mcqdMs94&q=$latitude,$longitude&zoom=18&maptype=satellite">
</script> -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_7AU1pVekCxM9B_sYj1e2gM8mcqdMs94&callback=initMap"></script>


<style>
#latitude,
#longitude {
    display: none;
    /* Menyembunyikan elemen input */
}
</style>

<script>
function initMap() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            var mapOptions = {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                zoom: 24 //untuk mengatur kedekatan maps
            };

            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

            var marker = new google.maps.Marker({
                position: {
                    lat: latitude,
                    lng: longitude
                },
                map: map,
                title: "Lokasi Anda"
            });
        });
    }
}
</script>


<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Konfigurasi database
        $host = 'sdb-l.hosting.stackcp.net'; // Ganti dengan nama host database Anda
        $username = 'ilenaclon-313932fc30'; // Ganti dengan username database Anda
        $password = 'oW&A{Q(z{Cvw'; // Ganti dengan password database Anda
        $database = 'ilenaclon-313932fc30'; // Ganti dengan nama database Anda
    
        // Koneksi ke database
        $koneksi = new mysqli($host, $username, $password, $database);
    
        // Periksa koneksi
        if ($koneksi->connect_error) {
            die("Koneksi database gagal: " . $koneksi->connect_error);
        }
    
        // Ambil data latitude dan longitude dari permintaan POST
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
    
        // Query untuk menyimpan data ke dalam tabel "absen"
        $sql = "INSERT INTO attendance_employees  (latitude, longitude) VALUES ('$latitude', '$longitude')";
    
        if ($koneksi->query($sql) === TRUE) {
            echo "Data berhasil disimpan.";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    
        // Tutup koneksi database
        $koneksi->close();
    }
    ?>

@endif
@endpush