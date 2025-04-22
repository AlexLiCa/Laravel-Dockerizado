<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Device Logs</title> {{-- Changed title --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            {{-- Basic Table Styles if Vite isn't running --}}
            <style>
                body { font-family: 'Instrument Sans', sans-serif; margin: 2rem; background-color: #f9fafb; color: #1f2937; }
                table { width: 100%; border-collapse: collapse; margin-top: 1rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); border-radius: 0.5rem; overflow: hidden; }
                th, td { padding: 0.75rem 1rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
                thead th { background-color: #f3f4f6; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; color: #4b5563; }
                tbody tr:nth-child(even) { background-color: #f9fafb; }
                tbody tr:hover { background-color: #f3f4f6; }
                .container { max-width: 80rem; margin-left: auto; margin-right: auto; padding: 1rem; }
                h1 { font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem; }
                .text-xs { font-size: 0.75rem; }
                .whitespace-nowrap { white-space: nowrap; }
                .text-center { text-align: center; }
                .text-red-500 { color: #ef4444; }
            </style>
        @endif
        {{-- Added basic styles as fallback --}}
    </head>
    <body class="antialiased">
        <div class="container mx-auto px-4 py-8"> {{-- Added a container --}}

            <h1>Device Connection Logs</h1> {{-- Simplified heading --}}

            {{-- Device Logs Table --}}
            <div class="overflow-x-auto shadow-md rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">IP Address</th>
                            <th scope="col" class="px-6 py-3">User Agent</th>
                            <th scope="col" class="px-6 py-3">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($deviceLogs)
                            @forelse ($deviceLogs as $log)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $log->ip_address }}</td>
                                    <td class="px-6 py-4 text-xs">{{ $log->user_agent }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="3" class="px-6 py-4 text-center">No connection logs yet.</td>
                                </tr>
                            @endforelse
                        @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="3" class="px-6 py-4 text-center text-red-500">Error: Device logs variable not passed to view.</td>
                            </tr>
                        @endisset
                    </tbody>
                </table>
            </div>
            {{-- End Device Logs Table --}}

        </div>
    </body>
</html>
