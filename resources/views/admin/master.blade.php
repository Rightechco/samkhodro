<!doctype html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    @laravelPWA
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/jquery-3.6.4.min.js"></script>
    @yield('links')
    @yield('links2')
    <style>
        nav {
            position: relative;
        }

        nav ul li:hover .underMenu {
            opacity: 1;
        }

        .underMenu {
            position: absolute;
            display: block !important;
            opacity: 0;
            margin-top: 5px;
            background-color: rgba(221, 227, 237,0.8);
            padding: 5px;
            min-width: 150px;
            border-radius: 12px;
            -webkit-transition: all 0.2s ease-in;
            -moz-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            -ms-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
        }

        .underMenu li {
            color: black;
            padding: 4px 0;
            margin: 7px;
        }

        .underMenu li a {
            color: black !important;
            font-size: 14px !important;
        }

        .spanStatus {
            position: absolute;
            left: 0;
            top: 0;
            padding: 7px;
            border-radius: 10px;
            font-family: irsans,irsans,sans-serif;
        }

        .span {
            padding: 7px;
            border-radius: 10px;
            font-family: irsans,irsans,sans-serif;
        }

        .badge-info {
            background-color: deepskyblue;
            color: white;
        }

        .badge-success {
            background-color: limegreen;
            color: white;
        }

        .badge-danger {
            background-color: darkred;
            color: white;
        }

        .box {
            background: white;
            box-shadow: 0 0 5px #eee;
            border-radius: 10px;
            overflow: hidden;
            padding: 10px 15px;
        }

        .box label {
            margin-top: 15px;
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #475569;
            font-weight: 300;
            font-size: .7rem;
            margin-bottom: .5rem;
        }

        .box input, .box textarea, .box select {
            background: white;
            border: 1px solid #eee;
            padding: .4rem .5rem;
            color: #475569;
            border-radius: .3rem;
            font-size: .7rem;
            width: 100%;
            transition: all .3s ease-in-out;
            outline: transparent;
        }

        .box button {
            margin: 15px 0;
            padding: 15px;
            width: 100%;
            background-color: #0f74a8;
            border-radius: .3rem;
            font-size: .7rem;
            transition: all .3s ease-in-out;
            outline: transparent;
            color: whitesmoke;
            font-size: 16px;
        }

        /* Table Styles */

        .table-wrapper{
            margin: 10px 70px 70px;
            box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
        }

        .fl-table {
            border-radius: 5px;
            font-size: 12px;
            font-weight: normal;
            border: none;
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            white-space: nowrap;
            background-color: white;
        }

        .fl-table td, .fl-table th {
            text-align: center;
            padding: 8px;
        }

        .fl-table td {
            border-right: 1px solid #f8f8f8;
            font-size: 12px;
        }

        .fl-table thead th {
            color: #ffffff;
            background: #4FC3A1;
        }


        .fl-table thead th:nth-child(odd) {
            color: #ffffff;
            background: #324960;
        }

        .fl-table tr:nth-child(even) {
            background: #F8F8F8;
        }

        /* Responsive */

        @media (max-width: 767px) {
            .fl-table {
                display: block;
                width: 100%;
            }
            .table-wrapper:before{
                content: "Scroll horizontally >";
                display: block;
                text-align: right;
                font-size: 11px;
                color: white;
                padding: 0 0 10px;
            }
            .fl-table thead, .fl-table tbody, .fl-table thead th {
                display: block;
            }
            .fl-table thead th:last-child{
                border-bottom: none;
            }
            .fl-table thead {
                float: left;
            }
            .fl-table tbody {
                width: auto;
                position: relative;
                overflow-x: auto;
            }
            .fl-table td, .fl-table th {
                padding: 20px .625em .625em .625em;
                height: 60px;
                vertical-align: middle;
                box-sizing: border-box;
                overflow-x: hidden;
                overflow-y: auto;
                width: 120px;
                font-size: 13px;
                text-overflow: ellipsis;
            }
            .fl-table thead th {
                text-align: left;
                border-bottom: 1px solid #f7f7f9;
            }
            .fl-table tbody tr {
                display: table-cell;
            }
            .fl-table tbody tr:nth-child(odd) {
                background: none;
            }
            .fl-table tr:nth-child(even) {
                background: transparent;
            }
            .fl-table tr td:nth-child(odd) {
                background: #F8F8F8;
                border-right: 1px solid #E6E4E4;
            }
            .fl-table tr td:nth-child(even) {
                border-right: 1px solid #E6E4E4;
            }
            .fl-table tbody td {
                display: block;
                text-align: center;
            }
        }
    </style>
    <link rel="stylesheet" href="/css/admin.css" type="text/css">
    <link rel="stylesheet" href="/css/icons.min.css" type="text/css">
</head>
<body>
    @include('icons')
    @include('admin.side.sidebar')
    @include('admin.header.header')
    <div class="allPanel">
        @yield('content')
    </div>
    @yield('script1')
    @yield('script2')
    @yield('scripts3')
    @yield('scripts4')
</body>
</html>
