<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan de Desarrollo Individual</title>
    <style>
        @page {
            margin: 50px 25px;
            margin-bottom: 50px;
            font-family: 'Arial', sans-serif;
            z-index: 0;
        }

        header {
            position: fixed;
            top: -30px;
            left: 0px;
            right: 0px;
            height: 50px;

            color: #000082;
            font-size: 15px;
            z-index: 10;
        }

        footer {
            position: fixed;
            bottom: -70px;
            left: -25px;
            right: 0px;
            height: 70px;
            width: calc(100% + 50px);

            color: #000082;
            font-size: 12px;
            padding-right: 10px;
            z-index: 10;
        }

        footer .text-footer {
            padding-right: 20px;
            padding-bottom: 15px;
        }

        footer .shape-footer {
            height: 30px;
            width: 100%;
            background-color: #000082;
            background-image: url({{ $_SERVER['DOCUMENT_ROOT'] . '/img/reports/footer_gradient.png' }});
            background-size: contain;
            color: white;
            text-align: center;
        }

        .pagenum:before {
            content: counter(page);
        }

        body {
            background-color: white;
            margin: 0;
            padding: 0;
            margin-top: 20px;
        }

        header .logo {
            height: 30px;
        }

        header table,
        header tr,
        header td {
            padding: 0px;
            vertical-align: middle;
            border-bottom: 1px solid #BEBED7;
            color: #BEBED7;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo-final {
            height: 100px;
        }

        .final-header {
            position: absolute;
            height: 40px;
            width: 100%;
            background-color: white;
            top: -35px;
            left: 0px;
            z-index: 100;
        }

        .final-footer {
            position: absolute;
            min-height: 70px;
            width: calc(100% + 20px);
            background-color: white;
            bottom: 0px;
            left: -10px;
            z-index: 100;
        }

        .final-footer p {
            color: #000082;
            font-size: 12px;
            border-top: 1px solid #BEBED7;
            margin-left: 90px;
            margin-right: 90px;
            padding-top: 20px;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .container {
            width: 85%;
            margin: 0px auto;
            background: #fff;
            padding: 0px;
        }

        .title,
        .subtitle {
            font-size: 36px;
            color: #000082;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .subtitle {
            font-size: 24px;
        }

        .label {
            color: #1432FF;
            line-height: .75em;
            margin: 0px;
        }

        .value {
            margin: 7px 0px 15px 0px;
            padding: 12px 25px;
            border: 1px #BEBED7 solid;
            border-radius: 8px;
            color: #000082;
            font-weight: 700;
        }

        .text-blue {
            color: #000082;
        }

        /* Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .w-25 {
            width: 25%;
        }

        .w-50 {
            width: 50%;
        }

        .w-75 {
            width: 75%;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .pe-3 {
            padding-right: 0.75rem;
        }

        .ps-3 {
            padding-left: 0.75rem;
        }

        .pt-3 {
            padding-top: 0.75rem;
        }

        .pb-3 {
            padding-bottom: 0.75rem;
        }

        .me-3 {
            margin-right: 0.75rem;
        }

        .ms-3 {
            margin-left: 0.75rem;
        }

        .mt-3 {
            margin-top: 0.75rem;
        }

        .mb-3 {
            margin-bottom: 0.75rem;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .p-0 {
            padding: 0px;
        }

        .m-0 {
            margin: 0px;
        }

        .highlighted {
            width: 85%;
            margin: 0px auto;
            background: #E6E6F0;
            padding: 10px 80px;
            margin-left: -25px;
            padding-bottom: 30px;
        }

        .highlighted table tr td p,
        .highlighted table tr td {
            vertical-align: sub;
        }

        .new_page {
            page-break-after: always;
        }

        .no-break {
            page-break-inside: avoid;
        }

        .first-header{
            position: absolute;
            top: -50px;
            left: -20px;
            height: 120px;
            background-color: white;
            width: 820px;
            z-index: 100;
        }

        .first-header .logo{
            position: absolute;
            top: 30px;
            left: 60px;
            height: 80px;
            z-index: 100;
        }

        .first-header .image{
            position: absolute;
            top: 0px;
            right: 0px;
            height: 120px;
            z-index: 100;
        }

        .main_result {
            width: 100px;
            vertical-align: middle;
            padding-top: 10px;
        }

        .main_result p {
            font-size: 30px;
            font-weight: bold;
            border: 1px #1432FF solid;
            color: #000082;
            border-radius: 5px;
            background-color: white;
            padding: 8px 12px 5px 12px;
            min-width: 40px;
            display: inline;
        }

        .label_result {
            width: 180px;
            vertical-align: middle;
            text-align: center;
        }

        .label_result p {
            font-size: 21px;
            font-weight: normal;
            color: #000082;
        }

        .inter_table {
            border-left: 1px #1432FF solid;
            border-right: 1px #1432FF solid;
        }

        .result_icon {
            height: 60px;
        }

        .result_icon.selected {
            height: 70px;
        }

        .icons_result {
            width: 350px;
        }

        .icons_result table tr td {
            width: 115px;
        }

        .text_result {
            font-size: 15px;
            font-weight: normal;
            color: #000082;
            width: 100%;
            margin-top: 0px;
            text-align: justify;
        }

        .chart_result {
            max-width: 1250px;
            margin-left: -30px;
        }

        .table_results {
            width: 650px;
            background-color: transparent;
            padding: 0;
            margin: 0;
            margin-top: 30px;
        }

        .table_results_pdi {
            width: 600px;
            background-color: transparent;
            padding: 0;
            margin: 0;
            margin-left: 25px;
            color: #000082;
        }

        .table_results .header {
            color: white;
            height: 40px;
            border-radius: 10px 10px 0px 0px;
            font-size: 20px;
            font-weight: bold;
            padding: 10px 30px;
        }

        .table_results .header .result-header-number  {
            font-size: 20px;
            font-weight: bold;
            color: #000082;
            background-color: white;
            border-radius: 5px;
            padding: 5px 10px;
            z-index: 100;
            width: 40px;
            float: right;
            margin-top: -5px;
        }

        .table_results .header-pdi {
            border-radius: 10px;
        }

        .table_results .header-pdi .result-pdi {
            font-size: 20px;
            font-weight: bold;
            color: #000082;
            background-color: white;
            border-radius: 5px;
            padding: 5px 10px;
            z-index: 100;
            width: auto;
        }

        .table_results .header-pdi .pdi-title {
            width: 520px;
        }

        .color_01 {
            background-color: #1432FF;
        }

        .color_02 {
            background-color: #0AD2B4;
        }

        .color_03 {
            background-color: #FF1E64;
        }

        .color_04 {
            background-color: #000082;
        }

        .higlighted_table{
            width: 630px;
        }

        .table_results .body {
            font-size: 15px;
            font-weight: normal;
            color: #000082;
            padding: 0;
            width: calc(100% - 15px);
        }

        .table_results .body-pdi {
            font-size: 15px;
            font-weight: normal;
            color: #000082;
            padding: 0;
            width: calc(100% - 15px);
            max-width: 400px;
            width: 400px;
        }

        .table_results .body .text {
            background-color: #E6E6F0;
            padding: 0px 30px;
            max-width: 400px;
            width: 400px;
            padding-top: 20px;
        }

        .table_results .body .result {
            background-color: #E6E6F0;
            max-width: 40px;
            padding-top: 20px;
        }

        .table_results .body .result .field {
            height: 25px;
            margin-bottom: -10px;
        }

        .table_results .body .result .result_icon {
            height: 60px;
        }

        .table_results .footer {
            background-color: #E6E6F0;
            height: 40px;
            border-radius: 0px 0px 10px 10px;
        }

        .table_results_detailed .header_detailed {
            font-size: 8px;
            width: 80px;
            vertical-align: middle;
        }

        .table_results_detailed .text_detailed {
            font-size: 14px;
            padding: 10px;
            padding-left: 0px;
            border-bottom: 1px solid #BEBED7;
        }

        .table_results_detailed .text_detailed.no_border_detailed {
            padding-bottom: 0px;
            border-bottom: none;
        }

        .table_results_pdi .container-grey {
            background-color: #E6E6F0;
            border-radius: 8px;
            padding: 15px 25px;
        }

        .table_results_pdi .container-grey a {
            color: #000082;
            text-decoration: none;
            font-size: 12px;
        }

        .align-middle {
            vertical-align: middle;
        }

        .display-inline {
            display: inline;
        }
    </style>
</head>

<body>
    <header>
        <table>
            <tr>
                <td>
                    INFORME DE RESULTADOS CON PLAN DE DESARROLLO DE INDIVIDUAL
                </td>
                <td class="text-right">
                    <img class="logo"
                        src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/logo_pdf.png')) }}">
                </td>
            </tr>
        </table>
    </header>

    <footer class="text-right">
        <div class="text-footer">
            Pag. <span class="pagenum"></span>
        </div>
        <div class="shape-footer"></div>
    </footer>

    <div class="first-header">
        <img class="logo"
            src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/reports/logo.png')) }}">
        <img class="image"
            src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/reports/header_img.png')) }}">
    </div>
    <main>
        <div class="container mb-3">
            <br>
            <br>
            <br>
            <br>
            <h1 class="title text-center pt-3 pb-2">INFORME DE RESULTADOS CON PLAN DE DESARROLLO DE INDIVIDUAL</h1>
            <br>
            <h2 class="subtitle pt-3 pb-3">Resumen Ejecutivo</h2>
            @if ($data['position']['organization'])
                <table>
                    <tr>
                        <td class="w-100">
                            <p class="label">Organización</p>
                            <p class="value">{{ $data['position']['organization']['name'] }}</p>
                        </td>
                    </tr>
                </table>
            @endif
            <table>
                <tr>
                    <td class="w-75 pe-3">
                        <p class="label">Candidato</p>
                        <p class="value">{{ $data['user']['name'] }}</p>
                    </td>
                    <td class="w-25 ps-3">
                        <p class="label">{{ $data['user']['document_type'] }}</p>
                        <p class="value text-center">{{ $data['user']['document_number'] }}</p>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td class="w-50 pe-3">
                        <p class="label">Nombre del proceso</p>
                        <p class="value">{{ $data['position']['name'] }}</p>
                    </td>
                    <td class="w-50 ps-3">
                        <p class="label">Grupo jerárquico</p>
                        <p class="value">{{ $data['position']['hierarchicalLevel']['name'] }}</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="highlighted mt-4">
            <h2 class="subtitle">Resultado general</h2>
            <table class="higlighted_table">
                <tr>
                    <td class="main_result">
                        <p>{{ $data['result']['average'] }}%</p>
                    </td>
                    <td class="label_result">
                        <p>Nivel {{ $data['result']['average_text'] }}</p>
                    </td>
                    <td class="icons_result">
                        <table>
                            <tr>
                                <td class="text-center">
                                    <img class="result_icon {{ ($data['result']['average_code'] == '1' ? 'selected' : 'mt-2')}}"
                                        src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/reports/level_1_' . ($data['result']['average_code'] == '1' ? 'selected' : 'normal') . '.png')) }}">
                                </td>
                                <td class="text-center inter_table">
                                    <img class="result_icon {{ ($data['result']['average_code'] == '2' ? 'selected' : 'mt-2')}}"
                                        src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/reports/level_2_' . ($data['result']['average_code'] == '2' ? 'selected' : 'normal') . '.png')) }}">
                                </td>
                                <td class="text-center">
                                    <img class="result_icon {{ ($data['result']['average_code'] == '3' ? 'selected' : 'mt-2')}}"
                                        src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/reports/level_3_' . ($data['result']['average_code'] == '3' ? 'selected' : 'normal') . '.png')) }}">
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <br>
                        <p class="text_result">
                            {{ $data['result']['comments'] }}
                        </p>
                        <br>
                    </td>
                </tr>
            </table>
        </div>
        <p class="new_page"></p>
        <div class="container mt-3">
            <h2 class="subtitle">Resultado por Habilidades</h2>
            <img class="chart_result" src="{{ $data['chart'] }}">
            @php $i = 1; @endphp
            @forelse ($data['result']['by_skills'] as $skill => $result)
                <table class="table_results mt-3 no-break">
                    <tr>
                        <td colspan="4" class="header color_0{{ $i }}">
                            <table class="w-100">
                                <tr>
                                    <td class="w-75 m-0 p-0">{{ $skill }}</td>
                                    <td class="w-25 m-0 p-0 text-right">
                                        <p class="result-header-number text-center p-0 m-0">{{ $data['result']['by_skills'][$skill]['result'] }}</p>
                                    </td>
                            </table>
                        </td>
                    </tr>
                    <tr class="body">
                        <td class="text">
                            {{ $result['description'] }}
                        </td>
                        <td class="result text-center">
                            <img class="field"
                                src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/reports/' . ($result['result_code'] == '1' ? 'checked' : 'unchecked') . '.png')) }}">
                            <br>
                            <br>
                            <img class="result_icon"
                                src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/reports/level_1_' . ($result['result_code'] == '1' ? 'highlighted' : 'normal') . '.png')) }}">
                        </td>
                        <td class="result text-center">
                            <img class="field"
                                src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/reports/' . ($result['result_code'] == '2' ? 'checked' : 'unchecked') . '.png')) }}">
                            <br>
                            <br>
                            <img class="result_icon"
                                src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/reports/level_2_' . ($result['result_code'] == '2' ? 'highlighted' : 'normal') . '.png')) }}">
                        </td>
                        <td class="result text-center">
                            <img class="field"
                                src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/reports/' . ($result['result_code'] == '3' ? 'checked' : 'unchecked') . '.png')) }}">
                            <br>
                            <br>
                            <img class="result_icon"
                                src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/reports/level_3_' . ($result['result_code'] == '3' ? 'highlighted' : 'normal') . '.png')) }}">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="footer"></td>
                    </tr>
                </table>
                @php $i = ($i<4?$i+1:1); @endphp
                @empty
            @endforelse
        </div>
        <p class="new_page"></p>
        <div class="container">
            <h2 class="subtitle">Plan de acción</h2>
            @php $i = 1; @endphp
            @forelse ($data['result']['skill_actions'] as $skill => $action_list )
                @php $j = 1; @endphp
                <div class="no-break">
                    <table class="table_results">
                        <tr>
                            <td class="header header-pdi color_0{{ $i }} p-0 m-0">
                                <table>
                                    <tr>
                                        <td class="p-0 m-0 pdi-title">
                                            <p class="p-0 m-0">{{ $skill }}</p>
                                        </td>
                                        <td class="text-right display-inline p-0 m-0 pdi-result">
                                            <p class="result-pdi text-center p-0 m-0">{{ $data['result']['by_skills'][$skill]['result'] }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                    @if (isset($action_list['actions']))
                    @foreach ($action_list['actions'] as $action_group => $actions)
                    <table class="table_results_pdi no-break">
                        <tr class="body-pdi">
                            <td>
                                <div class="container-grey mt-3 no-break">
                                    <h3 class="p-0 m-0">{{ $action_group }}</h3>
                                    <table>
                                        @foreach ($actions as $action)
                                            <tr>
                                                <td>
                                                    <a>
                                                    {{ $action }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                    @endforeach
                    @endif

                    @if (isset($action_list['links']))
                    <table class="table_results_pdi no-break">
                        <tr class="body-pdi">
                            <td>
                            @foreach ($action_list['links'] as $link_group => $links)
                                <div class="container-grey mt-3 no-break">
                                    <h3 class="p-0 m-0">{{ $link_group }}</h3>
                                    <table>
                                        @foreach ($links as $link)
                                            <tr>
                                                <td>
                                                    <a href="{!! $link->link !!}">
                                                        {!! $link->text !!}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                @php $j++; @endphp
                                @endforeach
                            </td>
                        </tr>
                    </table>
                    @endif
                </div>
                @php  $i = ($i<4?$i+1:1);  @endphp
            @empty
            @endforelse
            </div>
            <p class="new_page"></p>
            <div class="container">
                {!! str_repeat('<br>', 16) !!}
                <p class="text-center">
                    <img class="logo-final"
                        src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/img/logo_pdf.png')) }}">
                </p>
                <p class="text-center text-blue">
                    Plataforma de Evaluación
                </p>
            </div>
        </main>
        <div class="final-header"></div>
        <div class="final-footer">
            <p>
                <strong>AVISO DE CONFIDENCIALIDAD:</strong> Los datos de este documento son confidenciales y han sido
                proporcionados a usted previa autorización de Tezti del Reach HR Group. Todos los derechos reservados. La
                reproducción total o parcial de la presente información será penada con el máximo rigor de la ley por la
                protección de derechos de autor.
            </p>
        </div>
    </body>

    </html>
