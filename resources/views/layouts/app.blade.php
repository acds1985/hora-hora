<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Hora-Hora</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="http://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="http://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"> </script>
        <script>
            $(document).ready( function () {
                $('#tablecert').DataTable({
                    "language": {
                        "lengthMenu": "Exibindo _MENU_ resultados por pagina",
                        "zeroRecords": "Nada Encontrado, Sinto muito.",
                        "info": "Exbindo pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "Não há dados disponiveis...",
                        "infoFiltered": "(Pesquisado e um total de _MAX_ resultados)",
                        "search": "Pesquisar",
                        "paginate": {
                            "next": "Próximo",
                            "previous": "Anterior",
                            "first": "Primeiro",
                            "last": "Último"
                        }
                    }
                } );
           } );

        </script>
    </body>
</html>
