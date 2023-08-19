<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>{{$tender->tender}}</title>
    <style>
        table.table-bordered>thead>tr>th,
        table.table-bordered>tbody>tr>td {
            border: 1px solid black;
        }
    </style>
</head>

<body class="p-4">
    <table class="mb-4">
        <thead>
            <tr>
                <th class="text-center" style="vertical-align: middle; width: 25%;"><img src="{{asset('../../assets/img/petro-logo.png')}}" height="60"></th>
                <th class="text-center" style="vertical-align: middle; width: 50%;">
                    <h5>Rincian Harga Pekerjaan {{$tender->tender}}</h5>
                </th>
                <th class="text-center" style="vertical-align: middle; width: 25%;">
                    <p class="pb-0 mb-0" style="font-size: 12px;">Tanggal Cetak:<br> <span style="font-weight: normal;">{{date('d F Y H:i', strtotime(Carbon\Carbon::now()))}}</span></p>
                </th>
            </tr>
        </thead>
    </table>

    <table class="table table-bordered mt-0 pt-0">
        <thead>
            <tr>
                <th class="text-center" style="vertical-align: middle; width: 5%;">No.</th>
                <th class="text-center" style="vertical-align: middle; width: 35%;">Uraian Pekerjaan</th>
                <th class="text-center" style="vertical-align: middle; width: 8%;">Volume</th>
                <th class="text-center" style="vertical-align: middle; width: 7%;">Satuan</th>
                <th class="text-center" style="vertical-align: middle; width: 15%;">Harga Satuan (Rp)</th>
                <th class="text-center" style="vertical-align: middle; width: 20%;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pekerjaan as $jobs)
            <tr>
                <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td>
                <td style="vertical-align: middle;">{{$jobs->pekerjaan}}</td>
                <td class="text-center" style="vertical-align: middle;">@currency($jobs->volume)</td>
                <td class="text-center" style="vertical-align: middle;">{{$jobs->satuan}}</td>
                <td class="text-center" style="vertical-align: middle;"><span>Rp</span>@currency($jobs->harga)</td>
                <td style="vertical-align: middle;">{{$jobs->keterangan}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.print()
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>