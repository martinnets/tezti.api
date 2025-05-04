<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        * {
            font-family: Arial, sans-serif;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            background-color: #007bff;
            border: 1px solid #007bff;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            color: #fff;
            text-decoration: none;
            margin: 0.5rem 0;
        }

        .btn-xs {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 0.2rem;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
        }

        .btn-md {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border-radius: 0.3rem;
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1.25rem;
            border-radius: 0.35rem;
        }

        .btn-xl {
            padding: 1rem 2rem;
            font-size: 1.5rem;
            border-radius: 0.4rem;
        }

        .btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-primary {
            background-color: #1432FF;
            border-color: #1432FF;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 0.25rem;
            padding: 1.25rem;
            margin-bottom: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            font-weight: bold;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-title {
            margin-bottom: 0.75rem;
            font-size: 1.25rem;
            font-weight: 500;
        }

        .card-text {
            margin-bottom: 1rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #6c757d;
        }

        .card-footer {
            padding: 0.75rem 1.25rem;
            background-color: #f8f9fa;
            border-top: 1px solid #e0e0e0;
            border-bottom-left-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: 0.5rem;
            font-family: Arial, sans-serif;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 300;
            line-height: 1.2;
        }

        h2 {
            font-size: 2rem;
            font-weight: 300;
            line-height: 1.2;
        }

        h3 {
            font-size: 1.75rem;
            font-weight: 300;
            line-height: 1.2;
        }

        h4 {
            font-size: 1.5rem;
            font-weight: 300;
            line-height: 1.2;
        }

        h5 {
            font-size: 1.25rem;
            font-weight: 300;
            line-height: 1.2;
        }

        h6 {
            font-size: 1rem;
            font-weight: 300;
            line-height: 1.2;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
            font-family: Arial, sans-serif;
            font-size: 1rem;
            line-height: 1.5;
            color: #333;
        }

        .m-0 {
            margin: 0 !important;
        }

        .mt-1 {
            margin-top: 0.25rem !important;
        }

        .mt-2 {
            margin-top: 0.5rem !important;
        }

        .mt-3 {
            margin-top: 1rem !important;
        }

        .mt-4 {
            margin-top: 1.5rem !important;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .mb-1 {
            margin-bottom: 0.25rem !important;
        }

        .mb-2 {
            margin-bottom: 0.5rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .mb-5 {
            margin-bottom: 3rem !important;
        }

        .p-0 {
            padding: 0 !important;
        }

        .pt-1 {
            padding-top: 0.25rem !important;
        }

        .pt-2 {
            padding-top: 0.5rem !important;
        }

        .pt-3 {
            padding-top: 1rem !important;
        }

        .pt-4 {
            padding-top: 1.5rem !important;
        }

        .pt-5 {
            padding-top: 3rem !important;
        }

        .pb-1 {
            padding-bottom: 0.25rem !important;
        }

        .pb-2 {
            padding-bottom: 0.5rem !important;
        }

        .pb-3 {
            padding-bottom: 1rem !important;
        }

        .pb-4 {
            padding-bottom: 1.5rem !important;
        }

        .pb-5 {
            padding-bottom: 3rem !important;
        }

        .bg-primary {
            background-color: #1432FF !important;
            color: #ffffff !important;
        }

        .bg-secondary {
            background-color: #6c757d !important;
            color: #ffffff !important;
        }

        .bg-success {
            background-color: #28a745 !important;
            color: #ffffff !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
            color: #ffffff !important;
        }

        .bg-warning {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }

        .bg-info {
            background-color: #17a2b8 !important;
            color: #ffffff !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
            color: #212529 !important;
        }

        .bg-dark {
            background-color: #343a40 !important;
            color: #ffffff !important;
        }

        .bg-white {
            background-color: #ffffff !important;
            color: #212529 !important;
        }

        .bg-transparent {
            background-color: transparent !important;
            color: #212529 !important;
        }

        .text-primary {
            color: #1432FF !important;
        }

        .text-secondary {
            color: #6c757d !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .text-info {
            color: #17a2b8 !important;
        }

        .text-light {
            color: #f8f9fa !important;
        }

        .text-dark {
            color: #343a40 !important;
        }

        .text-body {
            color: #212529 !important;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .text-white {
            color: #fff !important;
        }

        .text-black-50 {
            color: rgba(0, 0, 0, 0.5) !important;
        }

        .text-white-50 {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col {
            flex: 1;
            padding-right: 15px;
            padding-left: 15px;
            max-width: 100%;
        }

        .col-1 {
            flex: 0 0 8.333333%;
            max-width: 8.333333%;
        }

        .col-2 {
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }

        .col-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .col-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .col-5 {
            flex: 0 0 41.666667%;
            max-width: 41.666667%;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-7 {
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
        }

        .col-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }

        .col-9 {
            flex: 0 0 75%;
            max-width: 75%;
        }

        .col-10 {
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }

        .col-11 {
            flex: 0 0 91.666667%;
            max-width: 91.666667%;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .no-gutters {
            margin-right: 0;
            margin-left: 0;
        }

        .no-gutters>.col {
            padding-right: 0;
            padding-left: 0;
        }

        .mx-auto {
            margin-right: auto;
            margin-left: auto;
        }

        .text-left {
            text-align: left !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-justify {
            text-align: justify !important;
        }

        .text-start {
            text-align: left !important;
        }

        .text-end {
            text-align: right !important;
        }

        .small {
            font-size: 80%;
            font-weight: 400;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        .font-weight-bolder {
            font-weight: bolder !important;
        }

        .font-weight-normal {
            font-weight: 400 !important;
        }

        .font-weight-light {
            font-weight: 300 !important;
        }

        .font-italic {
            font-style: italic !important;
        }

        .font-underline {
            text-decoration: underline !important;
        }

        .font-strikethrough {
            text-decoration: line-through !important;
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }

        .text-lowercase {
            text-transform: lowercase !important;
        }

        .text-capitalize {
            text-transform: capitalize !important;
        }

        .logo {
            width: 500px;
        }

        @media (max-width: 1024px) {
            .logo {
                width: 70%;
            }
        }

        @media (max-width: 520px) {
            .logo {
                width: 100%;
            }

            .col-6 {
                flex: 0 0 80%;
                max-width: 80%;
            }

            h4 {
                font-size: 1.25rem;
            }

            p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body class="bg-light">
    <div class="row">
        <div class="col-6 mx-auto mt-4">
            <div class="card bg-white">
                <div class="card-title text-center">
                    <img class="logo" src="https://teztieval.web.app/img/logo.png" alt="Logo App">
                </div>
                <div class="card-body">@yield('body')</div>
                <div class="card-footer text-center text-black-50">
                    <p class="small">Este es un correo automático del sistema, por favor no responder a él.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
