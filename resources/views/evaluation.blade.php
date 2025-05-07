<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon_tezti.png') }}">

    <title>Tezti - Evaluación</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <style>
        /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */
        *,
        ::after,
        ::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb
        }

        ::after,
        ::before {
            --tw-content: ''
        }

        :host,
        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            tab-size: 4;
            font-family: "Roboto", sans-serif, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            font-feature-settings: normal;
            font-variation-settings: normal;
            -webkit-tap-highlight-color: transparent
        }

        body {
            width: 100%;
            margin: 0;
            line-height: inherit
        }

        hr {
            height: 0;
            color: inherit;
            border-top-width: 1px
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        b,
        strong {
            font-weight: bolder
        }

        code,
        kbd,
        pre,
        samp {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-feature-settings: normal;
            font-variation-settings: normal;
            font-size: 1em
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        table {
            text-indent: 0;
            border-color: inherit;
            border-collapse: collapse
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            font-feature-settings: inherit;
            font-variation-settings: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            color: inherit;
            margin: 0;
            padding: 0
        }

        button,
        select {
            text-transform: none
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
            background-color: transparent;
            background-image: none
        }

        :-moz-focusring {
            outline: auto
        }

        :-moz-ui-invalid {
            box-shadow: none
        }

        progress {
            vertical-align: baseline
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        summary {
            display: list-item
        }

        blockquote,
        dd,
        dl,
        figure,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        p,
        pre {
            margin: 0
        }

        fieldset {
            margin: 0;
            padding: 0
        }

        legend {
            padding: 0
        }

        menu,
        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0
        }

        dialog {
            padding: 0
        }

        textarea {
            resize: vertical
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            color: #9ca3af
        }

        [role=button],
        button {
            cursor: pointer
        }

        :disabled {
            cursor: default
        }

        audio,
        canvas,
        embed,
        iframe,
        img,
        object,
        svg,
        video {
            display: block;
            vertical-align: middle
        }

        img,
        video {
            max-width: 100%;
            height: auto
        }

        [hidden] {
            display: none
        }

        *,
        ::before,
        ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        .absolute {
            position: absolute
        }

        .relative {
            position: relative
        }

        .-left-20 {
            left: -5rem
        }

        .top-0 {
            top: 0px
        }

        .-bottom-16 {
            bottom: -4rem
        }

        .-left-16 {
            left: -4rem
        }

        .-mx-3 {
            margin-left: -0.75rem;
            margin-right: -0.75rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .mt-6 {
            margin-top: 1.5rem
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .aspect-video {
            aspect-ratio: 16 / 9
        }

        .size-12 {
            width: 3rem;
            height: 3rem
        }

        .size-5 {
            width: 1.25rem;
            height: 1.25rem
        }

        .size-6 {
            width: 1.5rem;
            height: 1.5rem
        }

        .h-12 {
            height: 3rem
        }

        .h-40 {
            height: 10rem
        }

        .h-full {
            height: 100%
        }

        .min-h-screen {
            min-height: 100vh
        }

        .min-w-screen {
            min-width: 100% !important;
        }

        .w-full {
            width: 100%
        }

        .w-50 {
            width: 50%
        }

        .w-\[calc\(100\%\+8rem\)\] {
            width: calc(100% + 8rem)
        }

        .w-auto {
            width: auto
        }

        .max-w-\[877px\] {
            max-width: 877px
        }

        .max-w-2xl {
            max-width: 42rem
        }

        .flex-1 {
            flex: 1 1 0%
        }

        .shrink-0 {
            flex-shrink: 0
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }

        .flex-col {
            flex-direction: column
        }

        .items-start {
            align-items: flex-start
        }

        .items-center {
            align-items: center
        }

        .items-stretch {
            align-items: stretch
        }

        .justify-end {
            justify-content: flex-end
        }

        .justify-center {
            justify-content: center
        }

        .gap-2 {
            gap: 0.5rem
        }

        .gap-4 {
            gap: 1rem
        }

        .gap-6 {
            gap: 1.5rem
        }

        .self-center {
            align-self: center
        }

        .overflow-hidden {
            overflow: hidden
        }

        .rounded-\[10px\] {
            border-radius: 10px
        }

        .rounded-full {
            border-radius: 9999px
        }

        .rounded-lg {
            border-radius: 0.5rem
        }

        .rounded-md {
            border-radius: 0.375rem
        }

        .rounded-sm {
            border-radius: 0.125rem
        }

        .bg-\[\#000082\]\/10 {
            background-color: #000082
        }

        .bg-\[\#000082\] {
            background-color: #000082
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .bg-gradient-to-b {
            background-image: linear-gradient(to bottom, var(--tw-gradient-stops))
        }

        .from-transparent {
            --tw-gradient-from: transparent var(--tw-gradient-from-position);
            --tw-gradient-to: rgb(0 0 0 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .via-white {
            --tw-gradient-to: rgb(255 255 255 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)
        }

        .to-white {
            --tw-gradient-to: #fff var(--tw-gradient-to-position)
        }

        .stroke-\[\#000082\] {
            stroke: #000082
        }

        .object-cover {
            object-fit: cover
        }

        .object-top {
            object-position: top
        }

        h1 {
            font-size: 40px;
            font-weight: 600;
            color: #000082;
        }

        .p-6 {
            padding: 1.5rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .py-10 {
            padding-top: 2.5rem;
            padding-bottom: 2.5rem
        }

        .px-3 {
            padding-left: 0.75rem;
            padding-right: 0.75rem
        }

        .py-16 {
            padding-top: 4rem;
            padding-bottom: 4rem
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem
        }

        .pt-3 {
            padding-top: 0.75rem
        }

        .text-center {
            text-align: center
        }

        .font-sans {
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem
        }

        .text-sm\/relaxed {
            font-size: 0.875rem;
            line-height: 1.625
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .font-semibold {
            font-weight: 600
        }

        .text-black {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity))
        }

        .text-white {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .underline {
            -webkit-text-decoration-line: underline;
            text-decoration-line: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\] {
            --tw-shadow: 0px 14px 34px 0px rgba(0, 0, 0, 0.08);
            --tw-shadow-colored: 0px 14px 34px 0px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .ring-1 {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .ring-transparent {
            --tw-ring-color: transparent
        }

        .ring-white\/\[0\.05\] {
            --tw-ring-color: rgb(255 255 255 / 0.05)
        }

        .drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\] {
            --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.06));
            filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
        }

        .drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\] {
            --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.25));
            filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
        }

        .transition {
            transition-property: color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms
        }

        .duration-300 {
            transition-duration: 300ms
        }

        .selection\:bg-\[\#000082\] *::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(0 0 130 / var(--tw-bg-opacity))
        }

        .selection\:text-white *::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .selection\:bg-\[\#000082\]::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(0 0 130 / var(--tw-bg-opacity))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .hover\:text-black:hover {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity))
        }

        .hover\:text-black\/70:hover {
            color: rgb(0 0 0 / 0.7)
        }

        .hover\:ring-black\/20:hover {
            --tw-ring-color: rgb(0 0 0 / 0.2)
        }

        .focus\:outline-none:focus {
            outline: 2px solid transparent;
            outline-offset: 2px
        }

        .focus-visible\:ring-1:focus-visible {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .focus-visible\:ring-\[\#000082\]:focus-visible {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(0 0 130 / var(--tw-ring-opacity))
        }

        @media (min-width: 640px) {
            .sm\:size-16 {
                width: 4rem;
                height: 4rem
            }

            .sm\:size-6 {
                width: 1.5rem;
                height: 1.5rem
            }

            .sm\:pt-5 {
                padding-top: 1.25rem
            }
        }

        @media (min-width: 768px) {
            .md\:row-span-3 {
                grid-row: span 3 / span 3
            }
        }

        @media (min-width: 1024px) {
            .lg\:col-start-2 {
                grid-column-start: 2
            }

            .lg\:h-16 {
                height: 4rem
            }

            .lg\:max-w-7xl {
                max-width: 80rem
            }

            .lg\:grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr))
            }

            .lg\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }

            .lg\:flex-col {
                flex-direction: column
            }

            .lg\:items-end {
                align-items: flex-end
            }

            .lg\:justify-center {
                justify-content: center
            }

            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-10 {
                padding: 2.5rem
            }

            .lg\:pb-10 {
                padding-bottom: 2.5rem
            }

            .lg\:pt-0 {
                padding-top: 0px
            }

            .lg\:text-\[\#000082\] {
                --tw-text-opacity: 1;
                color: rgb(0 0 130 / var(--tw-text-opacity))
            }

        }

        .min-w-700 {
            min-width: 700px;
        }

        .mx-auto {
            margin-right: auto;
            margin-left: auto;
        }

        .label {
            font-size: 20px;
            font-weight: 400;
            color: #1432FF;
        }

        .value {
            border: 1px solid #bebed7;
            padding: 8px 18px;
            font-size: 24px;
            font-weight: 600;
            color: #000082;
        }

        .desktop {
            visibility: visible;
        }

        .mobile {
            visibility: hidden;
            display: none;
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
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            color: #fff;
            text-decoration: none;
            margin: 0.5rem 0;
        }

        .btn-start {
            background-color: #ff1e64;
            border-color: #ff1e64;
            color: white;
            font-size: 20px;
            font-weight: 600;
        }

        .iframe-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            max-width: 100%;
            max-height: 100%;
            overflow: hidden;
        }

        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            max-width: 100%;
            max-height: 100%;
            border: none;
        }

        @media (max-width: 520px) {

            .min-w-700,
            .w-full,
            .w-50 {
                min-width: 100%;
            }

            .w-50 {
                position: relative !important;
            }

            .desktop {
                visibility: hidden;
                display: none;
            }

            .mobile {
                visibility: visible;
                display: inherit;
            }
        }
    </style>
</head>

<body class="w-full">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen min-w-screen flex flex-col items-center justify-center selection:bg-[#000082] selection:text-white">
            @if ($case != 'ok' || ($position_user && $position_user->status != 1))
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="w-full">
                        <div class="flex lg:justify-center">
                            <img width="400" src="{{ asset('img/logo.png') }}" alt="Tezti Logo App">
                        </div>
                    </header>
            @endif

            <main class="mt-3 w-full">
                <form id="evaluationForm" action="{{ route('evaluation.save') }}" class="row" method="post">
                    @csrf
                    @switch($case)
                        @case('no-access')
                            <h1 class="text-center">El enlace es inválido o ha vencido.</h1>
                        @break

                        @case('no-position')
                            <div class="row py-10">
                                <h1 class="text-center">Hola, {{ $user->name }}</h1>
                            </div>
                        @break

                        @case('position-finished')
                            <div class="row py-10"> 
                                <h1 class="text-center">Hola, {{ $user->name }}</h1>
                                <p class="text-center">La posición se encuentra cerrada o inactiva.</p>
                            </div>
                        @break

                        @case('wrong-position')
                            <div class="row py-10">
                                <h1 class="text-center">Hola, {{ $user->name }}</h1>
                                <p class="text-center">La posición no existe.</p>
                            </div>
                        @break

                        @case('no-invited')
                            <div class="row py-10">
                                <h1 class="text-center">Hola, {{ $user->name }}</h1>
                                <p class="text-center">No has sido invitado a este proceso.</p>
                            </div>
                        @break

                        @case('ok')
                            <input type="hidden" name="access_token" value="{{ $token }}">
                            <input type="hidden" name="position_id" value="{{ $position->id }}">
                            <input type="hidden" name="behavior_id" value="{{ $behavior_id }}">
                            <input type="hidden" name="status" value="{{ $new_status }}">
                            @switch($position_user->status)
                                @case(0)
                                    <div class="grid py-10 mx-auto min-w-700 desktop">
                                        <h1 class="text-center">Te damos la bienvenida.</h1>
                                        <div class="w-50 flex gap-6 mx-auto py-2 grid-cols-2">
                                            <div class="w-50">
                                                <p class="label">Nombres:</p>
                                                <p class="value rounded-lg">{{ $user->name }}</p>
                                            </div>
                                            <div class="w-50">
                                                <p class="label">Apellidos:</p>
                                                <p class="value rounded-lg">{{ $user->lastname }}</p>
                                            </div>
                                        </div>
                                        <div class="w-50 flex gap-6 mx-auto py-2">
                                            <div class="w-50">
                                                <p class="label">Tipo de documento:</p>
                                                <p class="value rounded-lg">{{ $user->document_type }}</p>
                                            </div>
                                            <div class="w-50">
                                                <p class="label">Número de documento:</p>
                                                <p class="value rounded-lg">{{ $user->document_number }}</p>
                                            </div>
                                        </div>
                                        <div class="w-50 flex gap-6 mx-auto py-2">
                                            <div class="w-full">
                                                <p class="label">Nombre del proceso:</p>
                                                <p class="value rounded-lg">{{ $position->name }}</p>
                                            </div>
                                        </div>
                                        <div class="w-50 flex gap-6 mx-auto py-2">
                                            <div class="w-50">
                                                <p class="label">Desde:</p>
                                                <p class="value rounded-lg">
                                                    {{ \Carbon\Carbon::parse($position->from)->format('d/m/Y') }}</p>
                                            </div>
                                            <div class="w-50">
                                                <p class="label">Hasta:</p>
                                                <p class="value rounded-lg">
                                                    {{ \Carbon\Carbon::parse($position->to)->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid py-10 mx-auto min-w-700 mobile">
                                        <h1 class="text-center">Bienvenido, {{ $user->name }}</h1>
                                        <div class="w-50 flex gap-6 mx-auto py-2 grid-cols-2">
                                            <div class="w-50">
                                                <p class="label">Nombres y apellidos:</p>
                                                <p class="value rounded-lg">{{ $user->name }} {{ $user->lastname }}</p>
                                            </div>
                                        </div>
                                        <div class="w-50 flex gap-6 mx-auto py-2">
                                            <div class="w-50">
                                                <p class="label">{{ $user->document_type }}</p>
                                                <p class="value rounded-lg">{{ $user->document_number }}</p>
                                            </div>
                                        </div>
                                        <div class="w-50 flex gap-6 mx-auto py-2">
                                            <div class="w-full">
                                                <p class="label">Nombre del proceso:</p>
                                                <p class="value rounded-lg">{{ $position->name }}</p>
                                            </div>
                                        </div>
                                        <div class="w-50 flex gap-6 mx-auto py-2">
                                            <div class="w-50">
                                                <p class="label">Desde - Hasta:</p>
                                                <p class="value rounded-lg">
                                                    {{ \Carbon\Carbon::parse($position->from)->format('d/m/Y') }} -
                                                    {{ \Carbon\Carbon::parse($position->to)->format('d/m/Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full text-center">
                                        <button type="submit" class="btn btn-start rounded-lg mx-auto">Iniciar</button>
                                    </div>
                                @break

                                @case(1)
                                    <input type="hidden" id="save" name="save" value="1">
                                    <input type="hidden" id="result" name="result" value="0">
                                    <center>
                                        <div class="iframe-container">
                                            <iframe src="{{ $scorm_path }}" frameborder="0" width="100%" allowautoplay
                                                allowfullscreen></iframe>
                                        </div>
                                    </center>

                                    <script>
                                        // Check if the SCORM API is already defined in the global window object
                                        if (!window.API) {
                                            // Define a mock API object to enable communication with SCORM
                                            window.API = {
                                                LMSInitialize: function(arg) {
                                                    console.log("SCORM LMSInitialize called");
                                                    return "true";
                                                },
                                                LMSFinish: function(arg) {
                                                    console.log("SCORM LMSFinish called");
                                                    console.log('resultado:', window.scorm_result);
                                                    document.getElementById('result').value = window.scorm_result;
                                                    document.getElementById('evaluationForm').submit();
                                                     // Redirección a una URL externa después de completar todos los SCORMs
                                                    // setTimeout(function() {
                                                        
                                                    //     var token = "{{ $token }}";
                                                    //     var userId = "{{ $user->id }}"; // ID del usuario
                                                    //     var positionId = "{{ $position->id }}"; // ID del proceso 
                                                        
                                                    //     // Construir la URL con parámetros
                                                    //     var redirectUrl = "https://teztieval.web.app" + 
                                                    //                     "?access_token="+ encodeURIComponent(positionId) + 
                                                    //                     "&uid=" + encodeURIComponent(userId) + 
                                                    //                     "&position_id=" + encodeURIComponent(positionId) ;                                                        
                                                    //     // Redirigir a la URL de Evaluacion (Cognifit+)
                                                    //     window.location.href = redirectUrl;
                                                    // }, 1000);
                                                    return "true";
                                                },
                                                LMSGetValue: function(name) {
                                                    console.log("SCORM LMSGetValue called for", name);
                                                    if (name === "cmi.core.lesson_status") {
                                                        return "not attempted";
                                                    }
                                                    return ""; // Return the requested value
                                                },
                                                LMSSetValue: function(name, value) {
                                                    console.log("SCORM LMSSetValue called for", name, "with value", value);
                                                    if (name === 'cmi.core.score.raw') {
                                                        window.scorm_result = value;
                                                    }
                                                    if (name === 'cmi.core.lesson_status' && (value === 'completed' || value === 'passed')) {
                                                        // Podemos usar esto como señal alternativa para completar
                                                        window.scorm_completed = true;
                                                    }
                                                    return "true";
                                                },
                                                LMSCommit: function(arg) {
                                                    console.log("SCORM LMSCommit called");
                                                    return "true";
                                                },
                                                LMSGetLastError: function() {
                                                    return "0"; // No error
                                                },
                                                LMSGetErrorString: function(errorCode) {
                                                    return "No error";
                                                },
                                                LMSGetDiagnostic: function(errorCode) {
                                                    return "No diagnostic info";
                                                }
                                            };
                                        }
                                         
                                    </script>
                                @break

                                @case(2)
                                    <div class="row py-10 text-center">
                                        <h1>¡Gracias, {{ $user->name }}!</h1>
                                        <p>Hemos guardado todas tus respuestas y, a partir de aquí, nosotros continuaremos con este
                                            proceso.</p>
                                    </div>
                                @break
                            @endswitch
                        @break

                    @endswitch
                </form>
            </main>


            @if ($case != 'ok' || ($position_user && $position_user->status != 1))
                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    COPYRIGHT © {{ now()->format('Y') }} Tezti
                </footer>
        </div>
        @endif
    </div>
    </div>
</body>

</html>
